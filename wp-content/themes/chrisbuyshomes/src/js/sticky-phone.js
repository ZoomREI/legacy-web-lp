document.addEventListener("DOMContentLoaded", function () {
  const callUsButton = document.getElementById("floating-phone");

  if (callUsButton) {
    function checkScroll() {
      if (window.scrollY > 100) {
        callUsButton.style.display = "block";
      } else {
        callUsButton.style.display = "none";
      }
    }

    window.addEventListener("scroll", checkScroll);
    checkScroll(); // Initial check when the page loads
  }
});
