// import gsap from "gsap";
// import { Draggable } from "gsap/Draggable";


function loadCallback() {
	gsap.registerPlugin(Draggable);

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
}

document.addEventListener("DOMContentLoaded", function () {
	loadScript([
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Draggable.min.js',
	], loadCallback)
});
