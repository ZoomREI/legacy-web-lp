import gsap from "gsap";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";

gsap.registerPlugin(ScrollToPlugin);

document.addEventListener("DOMContentLoaded", function () {
	// Function to handle the carousel logic for smaller screens
	const initializeCarousel = () => {
		if (window.innerWidth < 1024) {
			const track = document.querySelector(".carousel-track");
			const slides = Array.from(track.children);
			const dotsNav = document.querySelector(".carousel-dots");
			const dots = Array.from(dotsNav.children);
			let currentSlideIndex = 0;
			let slideInterval;
			let isScrolling = false; // Flag to prevent double-triggering
			const slideGap = 0; // Adjust if there's any gap between slides
			const slideDuration = 3000; // Duration for auto-slide

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
					slide.style.left = `${(slideWidth + slideGap) * index}px`;
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
				const slideWidth = slides[0].getBoundingClientRect().width;
				const targetSlide = slides[targetIndex];
				const targetPosition =
					targetSlide.offsetLeft -
					(track.parentElement.getBoundingClientRect().width - slideWidth) / 2;

				isScrolling = true; // Set flag to prevent scroll-triggered updates

				gsap.to(track, {
					scrollTo: { x: targetPosition },
					duration: 0.6,
					ease: "power2.inOut",
					onComplete: () => {
						isScrolling = false; // Reset flag after animation completes
					},
				});
				updateDots(currentSlideIndex, targetIndex);
				currentSlideIndex = targetIndex;
			};

			const resetAutoSlide = () => {
				clearInterval(slideInterval);
				slideInterval = setInterval(autoSlide, slideDuration);
			};

			// Function to handle automatic sliding
			const autoSlide = () => {
				const nextSlideIndex = (currentSlideIndex + 1) % slides.length;
				moveToSlide(nextSlideIndex);
			};

			// Event listener for dot navigation
			dotsNav.addEventListener("click", (e) => {
				const targetDot = e.target.closest("span");
				if (!targetDot) return;

				const targetIndex = dots.findIndex((dot) => dot === targetDot);
				moveToSlide(targetIndex);

				// Reset and restart auto-slide
				resetAutoSlide();
			});

			// Sync dots based on scroll position
			track.addEventListener("scroll", () => {
				if (isScrolling) return; // Prevents handling the event during slide transition

				const slideWidth = slides[0].offsetWidth;
				const scrolledIndex = Math.round(track.scrollLeft / slideWidth);
				if (
					scrolledIndex !== currentSlideIndex &&
					scrolledIndex < dots.length
				) {
					updateDots(currentSlideIndex, scrolledIndex);
					currentSlideIndex = scrolledIndex;
					// Reset and restart auto-slide on manual scroll
					resetAutoSlide();
				}
			});

			// Set the initial active dot
			updateDots(-1, 0);

			// Start auto-slide
			slideInterval = setInterval(autoSlide, slideDuration);

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
		const track = document.querySelector(".carousel-track");
		track.removeAttribute("style"); // Reset inline styles added previously

		// Reinitialize if the condition is met
		initializeCarousel();
	});
});
