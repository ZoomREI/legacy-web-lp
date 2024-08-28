document.addEventListener("DOMContentLoaded", function () {
  // Select all parent menu items that have children
  var parentMenuItems = document.querySelectorAll(
    ".menu-item-has-children > a"
  );

  parentMenuItems.forEach(function (parentMenuItem) {
    parentMenuItem.addEventListener("click", function (e) {
      // Prevent the default behavior of the link if it has sub-items
      if (
        parentMenuItem.nextElementSibling &&
        parentMenuItem.nextElementSibling.classList.contains("sub-menu")
      ) {
        e.preventDefault();
        // Toggle the dropdown
        parentMenuItem.nextElementSibling.classList.toggle("visible");

        // Redirect to the link if it's already visible (i.e., second click)
        if (parentMenuItem.nextElementSibling.classList.contains("visible")) {
          window.location.href = parentMenuItem.href;
        }
      } else {
        // If no sub-items, just follow the link
        window.location.href = parentMenuItem.href;
      }
    });
  });
});
