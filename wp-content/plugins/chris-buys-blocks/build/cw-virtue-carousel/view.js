/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./src/cw-virtue-carousel/view.js ***!
  \****************************************/
document.addEventListener("DOMContentLoaded", function () {
  const track = document.querySelector(".cw-carousel-track");
  const slides = Array.from(track.children);
  const buttonNav = document.querySelector(".cw-carousel-nav");
  let currentSlide = 0;
  let slideWidth;
  // let slideInterval;

  // Function to set slide positions and handle resize
  const setSlidePositions = () => {
    slideWidth = slides[0].getBoundingClientRect().width;
    slides.forEach((slide, index) => {
      slide.style.left = slideWidth * index + "px";
    });
  };

  // Function to move to a specific slide
  const moveToSlide = (currentSlideIndex, targetSlideIndex) => {
    const targetSlide = slides[targetSlideIndex];
    track.style.transform = "translateX(-" + targetSlide.style.left + ")";
    return targetSlideIndex;
  };

  // Initialize carousel only if the screen width is below 1024px
  const initializeCarousel = () => {
    if (window.innerWidth < 1024) {
      setSlidePositions();
      moveToSlide(currentSlide, currentSlide);
    }
  };

  // Handle navbutton click navigation
  buttonNav.addEventListener("click", e => {
    if (window.innerWidth >= 1024) return;
    const targetButton = e.target.closest(".cw-carousel-nav__button");
    if (!targetButton) return;
    if (targetButton.classList.contains("cw-carousel-nav__button--prev")) {
      const prevSlide = (currentSlide + 1) % slides.length;
      currentSlide = moveToSlide(currentSlide, prevSlide);
    } else {
      const nextSlide = (currentSlide - 1 + slides.length) % slides.length;
      currentSlide = moveToSlide(currentSlide, nextSlide);
    }
    const targetIndex = dots.findIndex(dot => dot === targetDot);
    currentSlide = moveToSlide(currentSlide, targetIndex);
  });

  // Swipe functionality
  let startX, endX;
  track.addEventListener("touchstart", e => {
    if (window.innerWidth >= 1024) return;
    startX = e.touches[0].clientX;
  });
  track.addEventListener("touchmove", e => {
    if (window.innerWidth >= 1024) return;
    endX = e.touches[0].clientX;
  });
  track.addEventListener("touchend", () => {
    if (window.innerWidth >= 1024) return;
    const swipeThreshold = 50; // Minimum swipe distance to change slide
    if (startX - endX > swipeThreshold) {
      const nextSlide = (currentSlide + 1) % slides.length;
      currentSlide = moveToSlide(currentSlide, nextSlide);
    } else if (endX - startX > swipeThreshold) {
      const prevSlide = (currentSlide - 1 + slides.length) % slides.length;
      currentSlide = moveToSlide(currentSlide, prevSlide);
    }
  });

  // Initialize the carousel when the DOM is loaded
  initializeCarousel();

  // Reinitialize the carousel on window resize
  window.addEventListener("resize", initializeCarousel);
});
/******/ })()
;
//# sourceMappingURL=view.js.map