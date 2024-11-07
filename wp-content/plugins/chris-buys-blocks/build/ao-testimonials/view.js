/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./src/ao-testimonials/view.js ***!
  \*************************************/
// import gsap from "gsap";

function loadCallback() {
  // Initialize only if the viewport is desktop size
  if (window.innerWidth >= 1024) {
    const loadMoreButton = document.querySelector(".ao-testimonials__load-more");
    const testimonialsSection = document.querySelector(".ao-testimonials");
    loadMoreButton.addEventListener("click", function () {
      // Use GSAP to animate the expansion
      gsap.to(testimonialsSection, {
        // duration: 0.5, // Duration of the animation in seconds
        // height: "auto", // Change the height to auto for expansion
        // ease: "power2.inOut", // Easing function for smooth animation
        onComplete: () => {
          // Optionally add a class after the animation completes
          testimonialsSection.classList.add("ao-testimonials--expanded");
        }
      });
    });
  }
}
document.addEventListener("DOMContentLoaded", function () {
  loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', loadCallback);
});
/******/ })()
;
//# sourceMappingURL=view.js.map