document.addEventListener("DOMContentLoaded", function () {
  const mobileMenuButton = document.getElementById("mobile-menu-button");
  const mobileMenu = document.getElementById("mobile-menu");
  const closeMobileMenu = document.getElementById("close-mobile-menu");

  mobileMenuButton.addEventListener("click", function () {
    mobileMenu.classList.toggle("open");
  });

  closeMobileMenu.addEventListener("click", function () {
    mobileMenu.classList.remove("open");
  });

  const menuItems = document.querySelectorAll(".menu-item-has-children > a");
  menuItems.forEach(function (item) {
    item.addEventListener("click", function (e) {
      e.preventDefault();
      const submenu = this.nextElementSibling;
      submenu.classList.toggle("open");
      const icon = this.querySelector(".polygon-icon");
      icon.classList.toggle("open");
      icon.style.transform = submenu.classList.contains("open")
        ? "rotate(180deg)"
        : "rotate(90deg)";
    });
  });
});
