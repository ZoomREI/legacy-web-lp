import gsap from "gsap";

document.addEventListener("DOMContentLoaded", function () {
	const logosWrapper = document.querySelector(
		".ao-as-seen-on-carousel__logos-wrapper",
	);
	const logos = document.querySelector(".ao-as-seen-on-carousel__logos");

	function cloneLogos() {
		const logosWidth = logos.scrollWidth;

		// Remove any existing clones
		const clones = logos.querySelectorAll(".cloned");
		clones.forEach((clone) => clone.remove());

		// Clone each logo and append it to the wrapper
		const logoElements = logos.querySelectorAll(
			".ao-as-seen-on-carousel__logo",
		);
		logoElements.forEach((logo) => {
			const clone = logo.cloneNode(true);
			clone.classList.add("cloned"); // Add a class to differentiate the clone
			logos.appendChild(clone);
		});

		gsap.set(logos, { width: `${logosWidth * 2}px` });

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

	// Run on load
	checkScreenSize();

	// Re-run on window resize
	window.addEventListener("resize", checkScreenSize);
});
