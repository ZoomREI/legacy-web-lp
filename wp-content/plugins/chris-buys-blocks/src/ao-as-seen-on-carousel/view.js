// import gsap from "gsap";

function loadCallback() {
	const logos = document.querySelector(".ao-as-seen-on-carousel__logos");

	function cloneLogos() {
		const logosWidth = logos.scrollWidth;

		const clones = logos.querySelectorAll(".cloned");
		clones.forEach((clone) => clone.remove());

		const logoElements = logos.querySelectorAll(".ao-as-seen-on-carousel__logo");
		let cloneCount = Math.ceil(window.innerWidth / logosWidth) + 1;

		for (let i = 0; i < cloneCount; i++) {
			logoElements.forEach((logo) => {
				const clone = logo.cloneNode(true);
				clone.classList.add("cloned");
				logos.appendChild(clone);
			});
		}

		gsap.set(logos, { width: `${logos.scrollWidth}px` });

		gsap.to(logos, {
			x: `-${logosWidth}px`,
			duration: 20,
			ease: "none",
			repeat: -1,
			modifiers: {
				x: gsap.utils.unitize((x) => parseFloat(x) % logosWidth),
			},
		});
	}

	function checkScreenSize() {
		if (window.innerWidth < 1024 && !logos.classList.contains("animated")) {
			cloneLogos();
			logos.classList.add("animated"); // Mark as animated to avoid reapplying
		} else if (
			window.innerWidth >= 1024 &&
			logos.classList.contains("animated")
		) {
			// Remove clones and reset the animation
			const clones = logos.querySelectorAll(".cloned");
			clones.forEach((clone) => clone.remove());
			gsap.killTweensOf(logos);
			gsap.set(logos, { clearProps: "all" });
			logos.classList.remove("animated");
		}
	}

	checkScreenSize();

	window.addEventListener("resize", checkScreenSize);
}

document.addEventListener("DOMContentLoaded", function () {
	loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', loadCallback)
});