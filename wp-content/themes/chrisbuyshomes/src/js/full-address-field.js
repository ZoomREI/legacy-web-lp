function initAutocomplete() {
  const forms = document.querySelectorAll('form[id^="gform_"]');

  forms.forEach((form) => {
    const autocompleteField = form.querySelector(".autocomplete-field input");
    const streetAddressField = form.querySelector(".address_line_1 input");
    const cityField = form.querySelector(".address_city input");
    const stateField = form.querySelector(".address_state :is(select, input)");
    const zipcodeFields = form.querySelectorAll(".address_zip input");
    const submitButton = form.querySelector('input[type="submit"]');

    let zipcodeField = null;
    let isAddressValid = false;
    let errorMessageContainer; // To hold the error message container

    zipcodeFields.forEach((field) => {
      if (field) {
        zipcodeField = field;
      }
    });

    const missingFields = [];
    if (!autocompleteField) missingFields.push("autocompleteField");
    if (!streetAddressField) missingFields.push("streetAddressField");
    if (!cityField) missingFields.push("cityField");
    if (!stateField) missingFields.push("stateField");
    if (!zipcodeField) missingFields.push("zipcodeField");

    if (missingFields.length > 0) {
      console.error(`Required fields not found in form:`, form);
      console.error(`Missing fields:`, missingFields.join(", "));
      return;
    }

    submitButton.disabled = true;

    function validateAddress() {
      const place = autocomplete.getPlace();
      if (!place || !place.geometry) {
        isAddressValid = false;
        showError("Please re-enter and select your address from the dropdown");
        return;
      }

      let streetAddress = "";
      let city = "";
      let stateShort = "";
      let stateLong = "";
      let zipcode = "";
      let hasStreetNumber = false;

      for (const component of place.address_components) {
        const componentType = component.types[0];

        switch (componentType) {
          case "street_number":
            streetAddress = component.long_name;
            hasStreetNumber = true;
            break;
          case "route":
            streetAddress += " " + component.long_name;
            break;
          case "locality":
            city = component.long_name;
            break;
          case "administrative_area_level_1":
            stateShort = component.short_name;
            stateLong = component.long_name;
            break;
          case "postal_code":
            zipcode = component.long_name;
            break;
        }
      }

      if (!hasStreetNumber) {
        isAddressValid = false;
        showError("Address must include a street number");
        return;
      }

      // Populate the hidden fields
      streetAddressField.value = streetAddress;
      cityField.value = city;
      stateField.value = stateLong;
      zipcodeField.value = zipcode;

      // Update the autocomplete field with the full address
      autocompleteField.value = `${streetAddress}, ${city}, ${stateShort}, ${zipcode}`;

      // Address is valid
      isAddressValid = true;
      clearError(); // Clear error if valid
      autocompleteField.classList.remove("invalid"); // Remove invalid class
      submitButton.disabled = false; // Enable the submit button
    }

    // Initialize Google Maps Autocomplete
    let autocomplete = new google.maps.places.Autocomplete(autocompleteField, {
      types: ["address"],
      componentRestrictions: { country: "us" },
    });

    autocomplete.addListener("place_changed", validateAddress);

    // Handle form submission
    form.addEventListener("submit", function (event) {
      if (!isAddressValid) {
        event.preventDefault(); // Prevent form submission
        showError(
          "Please use the dropdown to enter a complete property address"
        );
      }
    });

    // Validate on blur event
    autocompleteField.addEventListener("blur", function () {
      if (!isAddressValid) {
        showError(
          "Please use the dropdown to enter a complete property address"
        );
      }
    });

    // Revalidate when the user changes the address
    autocompleteField.addEventListener("input", function () {
      isAddressValid = false;
      autocompleteField.classList.add("invalid"); // Add invalid class for styling
      submitButton.disabled = true; // Disable the submit button
      clearError(); // Clear any previous error messages
    });

    // Allow the user to re-trigger the autocomplete by clearing the field
    autocompleteField.addEventListener("input", function () {
      if (autocompleteField.value === "") {
        streetAddressField.value = "";
        cityField.value = "";
        stateField.value = "";
        zipcodeField.value = "";
        isAddressValid = false;
        autocompleteField.classList.add("invalid"); // Add invalid class for styling
        submitButton.disabled = true; // Disable the submit button
        clearError(); // Clear any previous error messages
      }
    });

    // Function to show error messages
    function showError(message) {
      if (!errorMessageContainer) {
        errorMessageContainer = document.createElement("div");
        errorMessageContainer.classList.add("error-message-container"); // Class for styling
        autocompleteField.parentNode.insertBefore(
          errorMessageContainer,
          autocompleteField.nextSibling
        ); // Insert below the input field
      }
      errorMessageContainer.textContent = message; // Display the message
      autocompleteField.classList.add("invalid"); // Add invalid class for styling
    }

    // Function to clear the error message
    function clearError() {
      if (errorMessageContainer) {
        errorMessageContainer.remove(); // Remove from DOM
        errorMessageContainer = null; // Reset the reference
      }
    }
  });
}

document.addEventListener("DOMContentLoaded", function () {
  if (
    typeof gform !== "undefined" &&
    typeof gform.initializeOnLoaded !== "undefined"
  ) {
    gform.initializeOnLoaded(function () {
      if (typeof google === "object" && typeof google.maps === "object") {
        initAutocomplete();
      } else {
        loadScript(
          "https://maps.googleapis.com/maps/api/js?key=AIzaSyCwwLF50kEF6wS1rTEqTDPfTXcSlF9REuI&libraries=places&callback=initAutocomplete"
        );
      }
    });
  }
});

function loadScript(src) {
  const script = document.createElement("script");
  script.type = "text/javascript";
  script.src = src;
  script.async = true;
  script.defer = true;
  document.head.appendChild(script);
}
