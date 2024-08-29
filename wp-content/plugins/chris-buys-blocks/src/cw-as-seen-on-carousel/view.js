// import gsap from "gsap";

// document.addEventListener("DOMContentLoaded", function () {
// 	const logosWrapper = document.querySelector(
// 		".cw-as-seen-on-carousel__logos-wrapper",
// 	);
// 	const logos = document.querySelector(".cw-as-seen-on-carousel__logos");

// 	function cloneLogos() {
// 		const logosWidth = logos.scrollWidth;

// 		// Remove any existing clones
// 		const clones = logos.querySelectorAll(".cloned");
// 		clones.forEach((clone) => clone.remove());

// 		// Clone each logo and append it to the wrapper
// 		const logoElements = logos.querySelectorAll(
// 			".cw-as-seen-on-carousel__logo",
// 		);
// 		logoElements.forEach((logo) => {
// 			const clone = logo.cloneNode(true);
// 			clone.classList.add("cloned"); // Add a class to differentiate the clone
// 			logos.appendChild(clone);
// 		});

// 		gsap.set(logos, { width: `${logosWidth * 2}px` });

// 		gsap.to(logos, {
// 			x: `-${logosWidth}px`,
// 			duration: 80,
// 			ease: "none",
// 			repeat: -1,
// 			modifiers: {
// 				x: gsap.utils.unitize((x) => parseFloat(x) % logosWidth),
// 			},
// 		});
// 	}

// 	function checkScreenSize() {
// 		// if (window.innerWidth < 1024 && !logos.classList.contains("animated")) {
// 		// 	cloneLogos();
// 		// 	logos.classList.add("animated"); // Mark as animated to avoid reapplying
// 		// } else if (
// 		// 	window.innerWidth >= 1024 &&
// 		// 	logos.classList.contains("animated")
// 		// ) {
// 		// 	// Remove clones and reset the animation
// 		// 	const clones = logos.querySelectorAll(".cloned");
// 		// 	clones.forEach((clone) => clone.remove());
// 		// 	gsap.killTweensOf(logos);
// 		// 	gsap.set(logos, { clearProps: "all" });
// 		// 	logos.classList.remove("animated");
// 		// }
// 		cloneLogos();
// 		logos.classList.add("animated");
// 	}

// 	// Run on load
// 	checkScreenSize();

// 	// Re-run on window resize
// 	window.addEventListener("resize", checkScreenSize);
// });

// //////////////////////////////////////////////
// //////////////////////////////////////////////
// //////////////////////////////////////////////
// //////////////////////////////////////////////
// //////////////////////////////////////////////
// //////////////////////////////////////////////
// //////////////////////////////////////////////
// //////////////////////////////////////////////
// //////////////////////////////////////////////
// //////////////////////////////////////////////
// //////////////////////////////////////////////
// //////////////////////////////////////////////
// //////////////////////////////////////////////
import gsap from "gsap";
import { Draggable } from "gsap/Draggable";

gsap.registerPlugin(Draggable);

document.addEventListener("DOMContentLoaded", function () {
	// var dots = document.querySelectorAll(".dot");

	var slideDelay = 0.02;
	var slideDuration = 5;
	var wrap = true;

	var slides = document.querySelectorAll(".cw-as-seen-on-carousel__logo");
	// var prevButton = document.querySelector("#prevButton");
	// var nextButton = document.querySelector("#nextButton");

	/////////////////////////////////////////////////////////////////////////////
	// let heightArr = [];
	// var elems = document.querySelectorAll(".cw-testimonials__testimonial");

	// elems.forEach((elem, index) => {
	// 	let heightBlock = elem.offsetHeight;
	// 	console.log(heightBlock);
	// 	heightArr.push(heightBlock);
	// });

	// function getMaxOfArray(numArray) {
	// 	return Math.max.apply(null, numArray);
	// }
	// let max = getMaxOfArray(heightArr);

	// // console.log(max);
	// const carouselWrapper = document.querySelector("._carousel-wrapper");
	// carouselWrapper.style.height = `${max}px`;
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
		trigger: ".cw-as-seen-on-carousel__container",
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

	// prevButton.addEventListener("click", function () {
	// 	animateSlides(1);
	// });

	// nextButton.addEventListener("click", function () {
	// 	animateSlides(-1);
	// });

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
