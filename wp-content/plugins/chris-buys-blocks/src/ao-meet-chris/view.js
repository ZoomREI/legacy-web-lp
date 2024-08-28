document.addEventListener("DOMContentLoaded", function () {
	const wrapperToMoveElement = document.querySelector(
		".ao-meet-chris__description",
	);
	const wrapperStartPosElement = document.querySelector(
		".ao-meet-chris__container",
	);
	const moveElement = document.querySelector(".ao-meet-chris__img");

	function moveBlock() {
		if (window.innerWidth < 1024) {
			wrapperToMoveElement.insertAdjacentElement("afterbegin", moveElement);
		} else {
			wrapperStartPosElement.insertAdjacentElement("beforeend", moveElement);
		}
	}
	// Run on load
	moveBlock();
	// Re-run on window resize
	window.addEventListener("resize", moveBlock);
});
