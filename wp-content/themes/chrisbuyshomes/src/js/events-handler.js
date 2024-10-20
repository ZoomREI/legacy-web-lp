document.addEventListener("DOMContentLoaded", () => {
  // Track if the form has been interacted with for the first time
  let formInteractionTracked = new Set();

  // Click Events using Event Delegation
  document.addEventListener("click", (event) => {
    // Call Button Click
    const callButton = event.target.closest("a.call-btn");
    if (callButton) {
      const parentSection = callButton.closest("header, footer, section");
      const location = parentSection
        ? parentSection.id || parentSection.className
        : "unknown";

      dataLayer.push({
        event: "call_click",
        call_click_id: callButton.id,
        call_click_location: location,
        href: callButton.href,
      });
    }

    // CTA Button Click
    if (event.target.matches(".cta-btn")) {
      const parentSection = event.target.closest("section");
      const sectionName = parentSection
        ? parentSection.id || parentSection.className
        : "unknown";

      dataLayer.push({
        event: "cta_click",
        cta_text: event.target.innerText,
        cta_section_name: sectionName,
      });
    }

    // FAQ Item Click
    if (event.target.matches(".faq-question")) {
      dataLayer.push({
        event: "faq_click",
        faq_question: event.target.innerText,
      });
    }

    // Form Submit Button Click
    if (event.target.matches('form input[type="submit"]')) {
      const form = event.target.closest("form");
      dataLayer.push({
        event: "form_submit",
        form_id: form.id,
        form_name: form.name,
      });
    }
  });

  // Form Events using Event Delegation
  document.addEventListener(
    "focus",
    (event) => {
      if (
        event.target.matches(
          'form input:not([type="submit"], [type="radio"], [type="checkbox"]), form select, form textarea'
        )
      ) {
        const form = event.target.closest("form");
        const label = findLabel(event.target);
        const labelText = label ? label.innerText.trim() : "unknown";

        dataLayer.push({
          event: "form_field_focus",
          form_id: form.id,
          form_name: form.name,
          form_field_label: labelText,
        });

        // Trigger form_start on first interaction (keystroke) in the form
        if (!formInteractionTracked.has(form)) {
          event.target.addEventListener("input", () => {
            if (!formInteractionTracked.has(form)) {
              formInteractionTracked.add(form);
              dataLayer.push({
                event: "form_start",
                form_id: form.id,
                form_name: form.name,
              });
            }
          });
        }
      }
    },
    true
  ); // Use the capture phase to detect focus events reliably

  document.addEventListener(
    "blur",
    (event) => {
      if (
        event.target.matches(
          'form input:not([type="submit"], [type="radio"], [type="checkbox"]), form select, form textarea'
        )
      ) {
        const form = event.target.closest("form");
        const label = findLabel(event.target);
        const labelText = label ? label.innerText.trim() : "unknown";
        const fieldValue = event.target.value || "";

        dataLayer.push({
          event: "form_field_blur",
          form_id: form.id,
          form_name: form.name,
          form_field_label: labelText,
          form_field_value: fieldValue, // Add the captured value to the data layer push
        });
      }
    },
    true
  ); // Use the capture phase to detect blur events reliably
});

// Helper function to find the corresponding label for an input
function findLabel(inputElement) {
  // Check if the input has an ID
  if (inputElement.id) {
    // Find a label with a "for" attribute matching the input's ID
    return document.querySelector(`label[for="${inputElement.id}"]`);
  }

  // Check if the input is wrapped in a label element
  let parent = inputElement.parentElement;
  while (parent) {
    if (parent.tagName.toLowerCase() === "label") {
      return parent;
    }
    parent = parent.parentElement;
  }

  // Return null if no label is found
  return null;
}
