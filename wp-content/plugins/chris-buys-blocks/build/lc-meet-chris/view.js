/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./src/lc-meet-chris/view.js ***!
  \***********************************/
// import gsap from "gsap";

function loadCallback() {
  const logosWrapper = document.querySelector(".lc-featured-in__logos-wrapper");
  const logos = document.querySelector(".lc-featured-in__logos");
  function cloneLogos() {
    const logosWidth = logos.scrollWidth;

    // Remove any existing clones
    const clones = logos.querySelectorAll(".cloned");
    clones.forEach(clone => clone.remove());

    // Clone each logo and append it to the wrapper
    const logoElements = logos.querySelectorAll(".lc-featured-in__logo");
    logoElements.forEach(logo => {
      const clone = logo.cloneNode(true);
      clone.classList.add("cloned"); // Add a class to differentiate the clone
      logos.appendChild(clone);
    });
    gsap.set(logos, {
      width: `${logosWidth * 2}px`
    });
    gsap.to(logos, {
      x: `-${logosWidth}px`,
      duration: 20,
      ease: "none",
      repeat: -1,
      modifiers: {
        x: gsap.utils.unitize(x => parseFloat(x) % logosWidth)
      }
    });
  }
  function checkScreenSize() {
    if (window.innerWidth < 1024 && !logos.classList.contains("animated")) {
      cloneLogos();
      logos.classList.add("animated"); // Mark as animated to avoid reapplying
    } else if (window.innerWidth >= 1024 && logos.classList.contains("animated")) {
      // Remove clones and reset the animation
      const clones = logos.querySelectorAll(".cloned");
      clones.forEach(clone => clone.remove());
      gsap.killTweensOf(logos);
      gsap.set(logos, {
        clearProps: "all"
      });
      logos.classList.remove("animated");
    }
  }

  // Run on load
  checkScreenSize();

  // Re-run on window resize
  window.addEventListener("resize", checkScreenSize);
}
document.addEventListener("DOMContentLoaded", function () {
  loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', loadCallback);
});
/******/ })()
;
//# sourceMappingURL=view.js.map