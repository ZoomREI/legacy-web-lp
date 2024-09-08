/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./src/cw-hero/view.js ***!
  \*****************************/
document.addEventListener("DOMContentLoaded", function () {
  const wrapperToMoveElement = document.querySelector(".cw-hero__titles h1");
  const wrapperStartPosElement = document.querySelector(".cw-hero");
  const moveElement = document.querySelector(".cw-hero__form");
  function moveBlock() {
    if (window.innerWidth < 1024) {
      wrapperToMoveElement.insertAdjacentElement("afterend", moveElement);
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