const sharp = require("sharp");
const fs = require("fs").promises;
const path = require("path");

const sizes = [150, 300, 768, 1024, 1536, 2048];
const manifestPath = path.join(__dirname, "image-manifest.json");
let manifest = {};

async function loadManifest() {
	try {
		console.log("Loading manifest...");
		const exists = await fs
			.access(manifestPath)
			.then(() => true)
			.catch(() => false);
		if (exists) {
			const manifestContent = (await fs.readFile(manifestPath, "utf-8")).trim();
			if (manifestContent.length > 0) {
				manifest = JSON.parse(manifestContent);
				console.log("Initial manifest:", manifest);
			} else {
				console.log("Manifest file is empty, initializing to empty object.");
				manifest = {};
			}
		} else {
			console.log(
				"Manifest file does not exist, initializing to empty object.",
			);
			manifest = {};
		}
	} catch (error) {
		console.error(
			"Error parsing manifest file, initializing empty manifest.",
			error,
		);
		manifest = {};
	}
}

async function saveManifest() {
	console.log("Saving manifest...");
	try {
		await fs.writeFile(manifestPath, JSON.stringify(manifest, null, 2));
		console.log("Manifest saved successfully.");
	} catch (error) {
		console.error("Error saving manifest file:", error);
	}
}

async function copySVGs(srcDir, destDir) {
	try {
		const files = await fs.readdir(srcDir);
		const svgFiles = files.filter((file) => file.endsWith(".svg"));

		await Promise.all(
			svgFiles.map(async (svg) => {
				const srcFilePath = path.join(srcDir, svg);
				const destFilePath = path.join(destDir, svg);
				const lastModified = (await fs.stat(srcFilePath)).mtimeMs;
				const relativeSvgPath = path.relative(__dirname, srcFilePath);

				// Skip copying if file is up-to-date
				if (
					manifest[relativeSvgPath] &&
					manifest[relativeSvgPath].lastModified === lastModified
				) {
					console.log(`Skipped copying ${svg}, already up-to-date.`);
					return;
				}

				// Copy file and update manifest
				await fs.copyFile(srcFilePath, destFilePath);
				manifest[relativeSvgPath] = { lastModified };
				console.log(`Copied ${svg} to ${destDir}`);
			}),
		);
	} catch (error) {
		console.error("Error copying SVGs:", error);
	}
}

async function renameFileIfNeeded(filePath) {
	const dir = path.dirname(filePath);
	const originalName = path.basename(filePath);
	const updatedName = originalName.replace(/--/g, "-");

	if (originalName !== updatedName) {
		const newFilePath = path.join(dir, updatedName);
		await fs.rename(filePath, newFilePath);
		console.log(`Renamed ${originalName} to ${updatedName}`);
		return newFilePath;
	}
	return filePath;
}

async function processImages() {
	try {
		const srcPath = path.join(__dirname, "../src");
		const folders = await fs.readdir(srcPath);
		const blockFolders = [];

		for (const folder of folders) {
			const assetsPath = path.join(srcPath, folder, "assets");
			const exists = await fs
				.access(assetsPath)
				.then(() => true)
				.catch(() => false);
			if (exists) {
				blockFolders.push(folder);
			}
		}

		for (const blockFolder of blockFolders) {
			const inputDir = path.join(srcPath, blockFolder, "assets");
			const outputDir = path.join(
				__dirname,
				"../optimized-assets",
				blockFolder,
			);

			await fs.mkdir(outputDir, { recursive: true });
			await copySVGs(inputDir, outputDir);

			const images = await fs.readdir(inputDir);

			const processingPromises = images.map(async (image) => {
				const ext = path.extname(image).toLowerCase();
				let imagePath = path.join(inputDir, image);

				imagePath = await renameFileIfNeeded(imagePath);

				const lastModified = (await fs.stat(imagePath)).mtimeMs;
				const relativeImagePath = path.relative(__dirname, imagePath);

				// Initialize manifest entry if not present
				if (!manifest[relativeImagePath]) {
					manifest[relativeImagePath] = {};
				}

				// Check if image processing is needed
				if (
					ext !== ".svg" &&
					manifest[relativeImagePath].lastModified !== lastModified
				) {
					// Get original image dimensions
					let metadata;
					try {
						metadata = await sharp(imagePath).metadata();
					} catch (err) {
						console.error(`Error reading metadata for ${imagePath}:`, err);
						return;
					}

					const originalWidth = metadata.width;
					const originalHeight = metadata.height;
					console.log(
						`Processing ${image} (${originalWidth}x${originalHeight})`,
					);

					let sizeReached = false;

					// Process image at each size up to and including the first size larger than original
					for (const size of sizes) {
						const outputPath = path.join(outputDir, `${path.parse(imagePath).name}-${size}.webp`);

						if (size <= originalWidth) {
							// Resize the image
							try {
								await sharp(imagePath)
									.resize({ width: size })
									.toFormat("webp", { quality: 85 }) // Adjust quality as needed
									.toFile(outputPath);
								console.log(`Created resized image ${outputPath}`);
							} catch (err) {
								console.error(`Error processing image ${imagePath}:`, err);
							}
						} else if (!sizeReached) {
							// Process one size larger than original without enlarging
							try {
								await sharp(imagePath)
									.resize({ width: size, withoutEnlargement: true })
									.toFormat("webp", { quality: 85 }) // Adjust quality as needed
									.toFile(outputPath);
								console.log(
									`Created image ${outputPath} without enlarging (original size)`,
								);
							} catch (err) {
								console.error(`Error processing image ${imagePath}:`, err);
							}
							sizeReached = true;
						} else {
							// Skip further sizes
							break;
						}
					}

					// Update manifest after processing
					manifest[relativeImagePath].lastModified = lastModified;
				} else if (ext !== ".svg") {
					console.log(`Skipped processing ${image}, already optimized.`);
				}
			});

			await Promise.all(processingPromises);
		}
	} catch (error) {
		console.error("Error processing images:", error);
	}
}

(async function main() {
	await loadManifest();
	await processImages();
	await saveManifest();
})();
