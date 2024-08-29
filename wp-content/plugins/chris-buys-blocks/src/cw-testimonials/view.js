import gsap from "gsap";
import { Draggable } from "gsap/Draggable";

gsap.registerPlugin(Draggable);

document.addEventListener("DOMContentLoaded", function () {
	var dots = document.querySelectorAll(".cw-dot");

	var slideDelay = 2;
	var slideDuration = 0.8;
	var wrap = true;

	var slides = document.querySelectorAll("._carousel-slide");
	var prevButton = document.querySelector("#prevButton");
	var nextButton = document.querySelector("#nextButton");

	/////////////////////////////////////////////////////////////////////////////
	let heightArr = [];
	var elems = document.querySelectorAll(".cw-testimonials__testimonial");

	elems.forEach((elem, index) => {
		let heightBlock = elem.offsetHeight;
		console.log(heightBlock);
		heightArr.push(heightBlock);
	});

	function getMaxOfArray(numArray) {
		return Math.max.apply(null, numArray);
	}
	let max = getMaxOfArray(heightArr);

	// console.log(max);
	const carouselWrapper = document.querySelector("._carousel-wrapper");
	carouselWrapper.style.height = `${max}px`;
	/////////////////////////////////////////////////////////////////////////////

	var progressWrap = gsap.utils.wrap(0, 1);

	var numSlides = slides.length;

	gsap.set(slides, {
		xPercent: (i) => i * 100,
	});

	var wrapX = gsap.utils.wrap(-100, (numSlides - 1) * 100);
	var timer = gsap.delayedCall(slideDelay, autoPlay);

	var animation = gsap.to(slides, {
		xPercent: "+=" + numSlides * 100,
		duration: 1,
		ease: "none",
		paused: true,
		repeat: -1,
		modifiers: {
			xPercent: wrapX,
		},
	});

	var proxy = document.createElement("div");
	var slideAnimation = gsap.to({}, {});
	var slideWidth = 0;
	var wrapWidth = 0;

	var draggable = new Draggable(proxy, {
		trigger: "._carousel-container",
		inertia: true,
		onPress: updateDraggable,
		onDrag: updateProgress,
		onThrowUpdate: updateProgress,
		snap: {
			x: snapX,
		},
	});

	resize();

	window.addEventListener("resize", resize);

	prevButton.addEventListener("click", function () {
		animateSlides(1);
	});

	nextButton.addEventListener("click", function () {
		animateSlides(-1);
	});

	function updateDraggable() {
		timer.restart(true);
		slideAnimation.kill();
		this.update();
	}

	function animateSlides(direction) {
		timer.restart(true);
		slideAnimation.kill();
		var x = snapX(gsap.getProperty(proxy, "x") + direction * slideWidth);

		slideAnimation = gsap.to(proxy, {
			x: x,
			duration: slideDuration,
			onUpdate: updateProgress,
		});
	}

	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	// dots.forEach((dot, index) => {
	// 	dot.addEventListener("click", function () {
	// 		this.classList.add("active");
	// 		maxWidth = wrapWidth;
	// 		prevMW = 0;

	// 		timer.restart(true);
	// 		slideAnimation.kill();
	// 		var x = snapX(1 + index * slideWidth);
	// 		console.log(dot);
	// 		console.log(x);
	// 		slideAnimation = gsap.to(proxy, {
	// 			x: x,
	// 			duration: slideDuration,
	// 			onUpdate: updateProgress,
	// 		});
	// 	});
	// });

	function autoPlay() {
		if (draggable.isPressed || draggable.isDragging || draggable.isThrowing) {
			timer.restart(true);
		} else {
			animateSlides(-1);
		}
	}

	var maxWidth = wrapWidth;
	var widthOneItem = maxWidth / slides.length;
	var prevMW = 0;

	function updateProgress() {
		animation.progress(progressWrap(gsap.getProperty(proxy, "x") / wrapWidth));
		// //////////////////////////////////////////////////////////////////////////
		let prog = Math.abs(gsap.getProperty(proxy, "x"));
		if (prog > maxWidth) {
			prevMW = maxWidth;
			maxWidth += wrapWidth;
		}
		dots.forEach((dot, index) => {
			dot.classList.remove("active");
			if (index === (prog - prevMW) / widthOneItem - 1) {
				dot.classList.add("active");
			}
		});
		// //////////////////////////////////////////////////////////////////////////
	}

	function snapX(value) {
		let snapped = gsap.utils.snap(slideWidth, value);
		return wrap
			? snapped
			: gsap.utils.clamp(-slideWidth * (numSlides - 1), 0, snapped);
	}

	function resize() {
		var norm = gsap.getProperty(proxy, "x") / wrapWidth || 0;

		slideWidth = slides[0].offsetWidth;
		wrapWidth = slideWidth * numSlides;

		wrap ||
			draggable.applyBounds({ minX: -slideWidth * (numSlides - 1), maxX: 0 });

		gsap.set(proxy, {
			x: norm * wrapWidth,
		});

		animateSlides(0);
		slideAnimation.progress(1);
	}
});

// ////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////
// import gsap from "gsap";
// import { ScrollToPlugin } from "gsap/ScrollToPlugin";
// ////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////
// import gsap from "gsap";

// import { ScrollToPlugin } from "gsap/ScrollToPlugin";

// gsap.registerPlugin(ScrollToPlugin);

// document.addEventListener("DOMContentLoaded", function () {
// 	// Function to handle the carousel logic for smaller screens
// 	const initializeCarousel = () => {
// 		const track = document.querySelector(".cw-testimonials__testimonials");
// 		const slides = Array.from(track.children);
// 		const dotsNav = document.querySelector(".cw-testimonials .cw-carousel-dots");
// 		const dots = Array.from(dotsNav.children);
// 		let currentSlideIndex = 0;
// 		let isScrolling = false; // Flag to indicate if scrolling is in progress

// 		// Function to manually cacwulate slide positions and handle resize
// 		const setSlidePositions = () => {
// 			const slideWidth = slides[0].getBoundingClientRect().width;
// 			const containerWidth = track.parentElement.getBoundingClientRect().width;
// 			const initialOffset = (containerWidth - slideWidth) / 2;

// 			// Set initial offset for the first slide
// 			track.style.paddingLeft = `${initialOffset}px`;

// 			// Adjust slides position
// 			slides.forEach((slide, index) => {
// 				slide.style.left = `${slideWidth * index}px`;
// 			});

// 			updateDots(-1, currentSlideIndex); // Initialize dots correctly
// 		};

// 		const updateDots = (currentIndex, targetIndex) => {
// 			if (dots[targetIndex]) {
// 				dots[currentIndex]?.classList.remove("active");
// 				dots[targetIndex].classList.add("active");
// 			}
// 		};

// 		const moveToSlide = (targetIndex) => {
// 			const slideWidth = slides[0].offsetWidth;
// 			const targetSlide = slides[targetIndex];
// 			const targetPosition =
// 				targetSlide.offsetLeft - (track.clientWidth - slideWidth) / 2;

// 			isScrolling = true; // Set the flag to true before starting the scroll
// 			gsap.to(track, {
// 				scrollTo: { x: targetPosition },
// 				duration: 0.6,
// 				ease: "power2.inOut",
// 				onComplete: () => {
// 					isScrolling = false; // Reset the flag once scrolling is complete
// 				},
// 			});
// 			updateDots(currentSlideIndex, targetIndex);
// 			currentSlideIndex = targetIndex;
// 		};

// 		// Event listener for dot navigation
// 		dotsNav.addEventListener("click", (e) => {
// 			const targetDot = e.target.closest("span");
// 			if (!targetDot) return;

// 			const targetIndex = dots.findIndex((dot) => dot === targetDot);
// 			moveToSlide(targetIndex);
// 		});

// 		// Sync dots based on scroll position
// 		track.addEventListener("scroll", () => {
// 			if (isScrolling) return; // Skip updating if scrolling is in progress

// 			const slideWidth = slides[0].offsetWidth;
// 			const scrolledIndex = Math.round(track.scrollLeft / slideWidth);
// 			if (scrolledIndex !== currentSlideIndex && scrolledIndex < dots.length) {
// 				updateDots(currentSlideIndex, scrolledIndex);
// 				currentSlideIndex = scrolledIndex;
// 			}
// 		});

// 		// Set the initial active dot
// 		updateDots(0, 0);

// 		// Set up slide positions on load and resize
// 		setSlidePositions();
// 	};

// 	// Initialize the carousel logic on page load
// 	initializeCarousel();
// });
