/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./src/ao-hero/view.js ***!
  \*****************************/
document.addEventListener("DOMContentLoaded", function () {
  const wrapperToMoveElement = document.querySelector(".ao-hero");
  const wrapperStartPosElement = document.querySelector(".ao-hero__content");
  const moveElement = document.querySelector(".ao-hero__bullet-points");
  function moveBlock() {
    if (window.innerWidth < 1024) {
      wrapperToMoveElement.insertAdjacentElement("beforeend", moveElement);
    } else {
      wrapperStartPosElement.insertAdjacentElement("beforeend", moveElement);
    }
  }
  // Run on load
  moveBlock();
  // Re-run on window resize
  window.addEventListener("resize", moveBlock);
});
/******/ })()
;
//# sourceMappingURL=view.js.map