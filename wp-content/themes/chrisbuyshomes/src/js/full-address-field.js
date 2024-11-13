function initAutocomplete() {
  const forms = document.querySelectorAll('form[id^="gform_"]');

  function initForm(form) {
    form.initted = true
    let fieldsToCheck = {
      'street': {
        'el': form.querySelector(".address_line_1 input"),
        'message': ''
      },
      'city': {
        'el': form.querySelector(".address_city input"),
        'message': ''
      },
      'state': {
        'el': form.querySelector(".address_state :is(select, input)"),
        'message': ''
      },
      'zipcode': {
        'el': Array.from(form.querySelectorAll(".address_zip input")).pop(),
        'message': ''
      },
      'name': {
        'el': form.querySelector(".dl-full-name input"),
        'message': 'Name cannot be empty'
      },
      'phone': {
        'el': form.querySelector(".dl-phone input"),
        'message': 'Phone cannot be empty'
      },
    };
    let autocompleteField = form.querySelector(".autocomplete-field input");
    let realSubmitButton = form.querySelector('[type="submit"]');

    if(!autocompleteField || !realSubmitButton){
      console.error(`Autocomplete field not found in form:`, form);
      return;
    }
    let windowQuery = new URLSearchParams(document.location.search)
    let submitButton = document.createElement('input')
    let addressFromQuery = window.addressFromQuery ? window.addressFromQuery : (windowQuery.get('propstreet') + windowQuery.get('propcity') + windowQuery.get('propstate') + windowQuery.get('propzip'))

    submitButton.setAttribute('type', 'submit')
    submitButton.setAttribute('class', realSubmitButton.getAttribute('class'))
    submitButton.value = realSubmitButton.value
    realSubmitButton.after(submitButton)
    realSubmitButton.style.position = 'absolute'
    realSubmitButton.style.left = '-99999px'

    function validateField(field, displayErrors = true) {
      let isValid = true;

      if (field.value.trim() === "") {
        if(field.message && displayErrors) {
          showError(field, field.message);
        }
        field.isValidField = false
        isValid = false
      } else {
        if(field.message) {
          clearError(field);
        }
        field.isValidField = true
      }

      return isValid
    }
    function validateFields(displayErrors = true) {
      let isValid = true;

      Object.keys(fieldsToCheck).forEach(function (fieldName) {
        let field = fieldsToCheck[fieldName]

        if(!validateField(field.el, displayErrors)){
          isValid = false;
        }
      })

      return isValid
    }
    function checkFields() {
      let missingFields = [];

      Object.keys(fieldsToCheck).forEach(function (fieldName) {
        let field = fieldsToCheck[fieldName]

        if(!field.el){
          missingFields.push(fieldName)
          return;
        }
        if(field.message){
          field.el.message = field.message
        }
        field.el.isContactField = true
      })
      return missingFields
    }
    function populateAddressFields(data = {}) {
      let hiddenFields = [
        'street',
        'city',
        'state',
        'zipcode'
      ]

      hiddenFields.forEach(function (fieldName) {
        fieldsToCheck[fieldName].el.value = data ? data[fieldName] || '' : ''
      })
    }

    let missingFields = checkFields()
    if (missingFields.length) {
      console.error(`Required fields not found in form:`, form);
      console.error(`Missing fields:`, missingFields.join(", "));
      return;
    }
    let autocomplete = new google.maps.places.Autocomplete(autocompleteField, {
      types: ["address"],
      componentRestrictions: { country: "us" },
    });

    let errorMessageContainers = {};
    let lastAddressError = null;

    // Error Tracking Function
    function trackError(field, message) {
      const label = findLabel(field);
      const labelText = label ? label.innerText.trim() : "unknown";
      dataLayer.push({
        event: "form_error",
        form_id: form.id,
        form_name: form.name,
        error_field_label: labelText,
        error_message: message,
      });
    }

    // Helper function to find the corresponding label for an input
    function findLabel(inputElement) {
      if (inputElement.id) {
        return document.querySelector(`label[for="${inputElement.id}"]`);
      }

      let parent = inputElement.parentElement;
      while (parent) {
        if (parent.tagName.toLowerCase() === "label") {
          return parent;
        }
        parent = parent.parentElement;
      }

      return null;
    }

    function showError(field, message) {
      if (!errorMessageContainers[field.name]) {
        const errorMessageContainer = document.createElement("div");
        errorMessageContainer.classList.add("error-message-container");
        field.parentNode.insertBefore(errorMessageContainer, field.nextSibling);
        errorMessageContainers[field.name] = errorMessageContainer;
      }
      errorMessageContainers[field.name].textContent = message;
      field.classList.add("invalid");

      // Track the error in the dataLayer
      trackError(field, message);
    }
    function clearError(field) {
      if (errorMessageContainers[field.name]) {
        errorMessageContainers[field.name].remove();
        delete errorMessageContainers[field.name];
      }
      field.classList.remove("invalid");
    }

    function validateAddress(displayErrors = true) {
      const place = autocomplete.getPlace();

      if (!place || !place.geometry) {
        if(addressFromQuery === fieldsToCheck.street.el.value + fieldsToCheck.city.el.value + fieldsToCheck.state.el.value + fieldsToCheck.zipcode.el.value){
          autocompleteField.isValidField = true;
          lastAddressError = null;
          clearError(autocompleteField)
          return true;
        } else {
          autocompleteField.isValidField = false;
          if (displayErrors) {
            lastAddressError =
              "Please re-enter and select your address from the dropdown";
            showError(autocompleteField, lastAddressError);
          }
          return false;
        }
      }
      let addressData = {
        'street': '',
        'city': '',
        'state': '',
        'zipcode': ''
      }
      let stateShort = "";
      let hasStreetNumber = false;

      for (const component of place.address_components) {
        const componentType = component.types[0];

        switch (componentType) {
          case "street_number":
            addressData.street = component.long_name;
            hasStreetNumber = true;
            break;
          case "route":
            addressData.street += " " + component.long_name;
            break;
          case "locality":
            addressData.city = component.long_name;
            break;
          case "administrative_area_level_1":
            addressData.state =component.long_name;
            stateShort = component.short_name;
            break;
          case "postal_code":
            addressData.zipcode = component.long_name;
            break;
        }
      }

      if (!hasStreetNumber) {
        autocompleteField.isValidField = false;
        if(displayErrors) {
          lastAddressError = "Address must include a street number";
          showError(autocompleteField, lastAddressError);
        }
        return false;
      }
      autocompleteField.isValidField = true;
      lastAddressError = null;
      autocompleteField.value = `${addressData.street}, ${addressData.city}, ${stateShort}, ${addressData.zipcode}`;

      window.addressFromQuery = addressFromQuery = addressData.street + addressData.city + addressData.state + addressData.zipcode

      clearError(autocompleteField)
      populateAddressFields(addressData)

      return true
    }

    autocomplete.addListener("place_changed", function () {
      validateAddress()
    });

    autocompleteField.addEventListener("input", function () {
      autocompleteField.hadInput = true
    })
    autocompleteField.addEventListener("focusout", function () {
      if(!autocompleteField.value.trim() && autocompleteField.hadInput) {
        autocompleteField.isValidField = false;
        lastAddressError = "Please re-enter and select your address from the dropdown";
        showError(autocompleteField, lastAddressError);
      }
    });

    form.addEventListener("focusout", function (e) {
      if(e.target.isContactField && e.target.focusOutErrors) {
        validateField(e.target)
      }
    });
    form.addEventListener("input", function (e) {
      if(e.target.isContactField) {
        e.target.focusOutErrors = true
      }
    });
    submitButton.addEventListener("click", function (e) {
      e.preventDefault()
      e.stopPropagation()
      e.stopImmediatePropagation()
      form.focusOutErrors = true

      if(validateAddress() && validateFields()){
        realSubmitButton.click()
      }
    });
  }

  setInterval(function () {
    document.querySelectorAll('form[id^="gform_"]').forEach((form) => {
      if(!form.initted) {
        initForm(form)
      }
    });
  }, 500)

  forms.forEach((form) => {
    initForm(form)
  });
}

document.addEventListener("DOMContentLoaded", function () {
  if (
    typeof gform !== "undefined" &&
    typeof gform.initializeOnLoaded !== "undefined"
  ) {
    gform.initializeOnLoaded(function () {
      loadScript(
        "https://maps.googleapis.com/maps/api/js?key=AIzaSyCwwLF50kEF6wS1rTEqTDPfTXcSlF9REuI&libraries=places",
        initAutocomplete
      );
    });
  }
});
