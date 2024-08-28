import gsap from "gsap";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";

gsap.registerPlugin(ScrollToPlugin);

document.addEventListener("DOMContentLoaded", function () {
	// Function to handle the carousel logic for smaller screens
	const initializeCarousel = () => {
		if (window.innerWidth < 1024) {
			const track = document.querySelector(".lc-testimonials__testimonials");
			const slides = Array.from(track.children);
			const dotsNav = document.querySelector(".lc-testimonials .carousel-dots");
			const dots = Array.from(dotsNav.children);
			let currentSlideIndex = 0;
			let isScrolling = false; // Flag to indicate if scrolling is in progress

			// Function to manually calculate slide positions and handle resize
			const setSlidePositions = () => {
				const slideWidth = slides[0].getBoundingClientRect().width;
				const containerWidth =
					track.parentElement.getBoundingClientRect().width;
				const initialOffset = (containerWidth - slideWidth) / 2;

				// Set initial offset for the first slide
				track.style.paddingLeft = `${initialOffset}px`;

				// Adjust slides position
				slides.forEach((slide, index) => {
					slide.style.left = `${slideWidth * index}px`;
				});

				updateDots(-1, currentSlideIndex); // Initialize dots correctly
			};

			const updateDots = (currentIndex, targetIndex) => {
				if (dots[targetIndex]) {
					dots[currentIndex]?.classList.remove("active");
					dots[targetIndex].classList.add("active");
				}
			};

			const moveToSlide = (targetIndex) => {
				const slideWidth = slides[0].offsetWidth;
				const targetSlide = slides[targetIndex];
				const targetPosition =
					targetSlide.offsetLeft - (track.clientWidth - slideWidth) / 2;

				isScrolling = true; // Set the flag to true before starting the scroll
				gsap.to(track, {
					scrollTo: { x: targetPosition },
					duration: 0.6,
					ease: "power2.inOut",
					onComplete: () => {
						isScrolling = false; // Reset the flag once scrolling is complete
					},
				});
				updateDots(currentSlideIndex, targetIndex);
				currentSlideIndex = targetIndex;
			};

			// Event listener for dot navigation
			dotsNav.addEventListener("click", (e) => {
				const targetDot = e.target.closest("span");
				if (!targetDot) return;

				const targetIndex = dots.findIndex((dot) => dot === targetDot);
				moveToSlide(targetIndex);
			});

			// Sync dots based on scroll position
			track.addEventListener("scroll", () => {
				if (isScrolling) return; // Skip updating if scrolling is in progress

				const slideWidth = slides[0].offsetWidth;
				const scrolledIndex = Math.round(track.scrollLeft / slideWidth);
				if (
					scrolledIndex !== currentSlideIndex &&
					scrolledIndex < dots.length
				) {
					updateDots(currentSlideIndex, scrolledIndex);
					currentSlideIndex = scrolledIndex;
				}
			});

			// Set the initial active dot
			updateDots(0, 0);

			// Set up slide positions on load and resize
			setSlidePositions();
			window.addEventListener("resize", setSlidePositions);
		}
	};

	// Initialize the carousel logic on page load
	initializeCarousel();

	// Re-check and reinitialize the carousel logic on window resize
	window.addEventListener("resize", () => {
		// Remove any previously added event listeners to avoid duplication
		const track = document.querySelector(".lc-testimonials__testimonials");
		track.removeAttribute("style"); // Reset inline styles added previously

		// Reinitialize if the condition is met
		initializeCarousel();
	});
});

document.addEventListener("DOMContentLoaded", function () {
	// Initialize only if the viewport is desktop size
	if (window.innerWidth >= 1024) {
		const loadMoreButton = document.querySelector(
			".lc-testimonials__load-more",
		);
		const testimonialsSection = document.querySelector(".lc-testimonials");

		loadMoreButton.addEventListener("click", function () {
			testimonialsSection.classList.add("lc-testimonials--expanded");
		});
	}
});
