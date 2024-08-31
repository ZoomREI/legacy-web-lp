function initAutocomplete() {
  const forms = document.querySelectorAll('form[id^="gform_"]');

  forms.forEach((form) => {
    const autocompleteField = form.querySelector(".autocomplete-field input"); // Autocomplete field
    const streetAddressField = form.querySelector(".address_line_1 input"); // Street address field
    const cityField = form.querySelector(".address_city input"); // City field
    const stateField = form.querySelector(".address_state select"); // State field (as select)
    const zipcodeFields = form.querySelectorAll(".address_zip input"); // Zipcode fields

    let zipcodeField = null;
    let isAddressValid = false;

    // Ensure we select the right field if there are multiple
    zipcodeFields.forEach((field) => {
      if (field) {
        zipcodeField = field;
      }
    });

    // Check for missing required fields
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

    // Function to validate address and show message if invalid
    function validateAddress() {
      const place = autocomplete.getPlace();
      if (!place || !place.geometry) {
        isAddressValid = false;
        handleInvalidAddress(
          autocompleteField,
          "Please select a valid address."
        );
        return;
      }

      let streetAddress = "";
      let city = "";
      let stateShort = "";
      let stateLong = "";
      let zipcode = "";
      let country = "";
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
          case "country":
            if (component.short_name === "US") {
              country = "USA";
            }
            break;
        }
      }

      if (!hasStreetNumber) {
        isAddressValid = false;
        handleInvalidAddress(
          autocompleteField,
          "Address must include a street number."
        );
        return;
      }

      // Populate the hidden fields
      streetAddressField.value = streetAddress;
      cityField.value = city;
      stateField.value = stateShort;
      zipcodeField.value = zipcode;

      // Update the autocomplete field with the full address
      autocompleteField.value = `${streetAddress}, ${city}, ${stateShort}, ${zipcode}`;

      // Address is valid
      isAddressValid = true;
      autocompleteField.setCustomValidity(""); // Clear any previous custom validity message
      autocompleteField.classList.remove("invalid");

      // Log the populated address components
      console.log("Address populated:", {
        streetAddress,
        city,
        stateShort,
        stateLong,
        zipcode,
        country,
      });
    }

    // Initialize Google Maps Autocomplete
    let autocomplete = new google.maps.places.Autocomplete(autocompleteField, {
      types: ["address"],
      componentRestrictions: { country: "us" },
    });

    autocomplete.addListener("place_changed", validateAddress);

    // Handle Gravity Forms pre-submission validation
    gform.addFilter("gform_pre_submission", function (formId) {
      console.log("Pre-submission validation...");

      if (!isAddressValid) {
        console.warn("Invalid address detected. Blocking submission.");
        handleInvalidAddress(
          autocompleteField,
          "Please use autocomplete to enter a complete property address."
        );
        return false; // Block form submission if the address is invalid
      }

      // Address is valid, allowing form submission.
      console.log("Address is valid, allowing form submission.");
      return true;
    });

    // Revalidate when the user changes the address
    autocompleteField.addEventListener("input", function () {
      isAddressValid = false;
      autocompleteField.setCustomValidity(""); // Reset custom validity message
      autocompleteField.classList.remove("invalid");
    });

    // Allow the user to re-trigger the autocomplete by clearing the field
    autocompleteField.addEventListener("input", function () {
      if (autocompleteField.value === "") {
        streetAddressField.value = "";
        cityField.value = "";
        stateField.value = "";
        zipcodeField.value = "";
        isAddressValid = false;
        autocompleteField.classList.add("invalid");
      }
    });
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

// Function to handle invalid addresses (e.g., missing street number)
function handleInvalidAddress(autocompleteField, message) {
  console.log("Handling invalid address, setting custom validity message.");
  autocompleteField.classList.add("invalid");
  autocompleteField.setCustomValidity(message);
  autocompleteField.reportValidity(); // Trigger native validation UI
}
