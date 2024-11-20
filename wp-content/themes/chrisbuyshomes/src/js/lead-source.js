// Function to get a value from local storage
function getLocalStorage(key) {
  return localStorage.getItem(key);
}

// Function to set a value in local storage
function setLocalStorage(key, value) {
  localStorage.setItem(key, value);
}

// Function to get query parameters from the URL
function getQueryParams() {
  return new URLSearchParams(window.location.search);
}

// Function to detect the lead source based on referrer and URL parameters
function detectInitialLeadSource() {
  const referrer = document.referrer;
  const queryParams = getQueryParams();

  // Check for Google Ads (gclid parameter)
  if (queryParams.has("gclid")) {
    return "Google Ads";
  }

  // Check for Google My Business (utm_campaign=gmb or referrer from Maps)
  if (
    queryParams.get("utm_campaign") === "gmb" ||
    referrer.includes("google.com/maps") ||
    referrer.includes("google.com/local")
  ) {
    return "Google My Business";
  }

  // Check for Facebook and Instagram (case-sensitive as requested)
  if (referrer.includes("facebook.com")) {
    return "facebook";
  }
  if (referrer.includes("instagram.com")) {
    return "instagram";
  }

  // Check for Bing Ads group individually (Yahoo, Bing, msn.com)
  if (referrer.includes("yahoo.com")) {
    return "Yahoo";
  }
  if (referrer.includes("bing.com")) {
    return "Bing";
  }
  if (referrer.includes("msn.com")) {
    return "MSN";
  }

  // Check for Google Search, direct traffic, or BBB
  if (referrer.includes("google.com")) {
    return "Google Search";
  }
  if (referrer === "") {
    return "direct"; // No referrer means direct traffic
  }
  if (referrer.includes("bbb.org")) {
    return "bbb";
  }

  // Return empty string if no recognized referrer (instead of "Default")
  return "";
}

// Function to store the lead source (only if it's not already stored)
function storeInitialLeadSource() {
  const storedLeadSource = getLocalStorage("Initial_Lead_Source");
  if (!storedLeadSource) {
    const leadSource = detectInitialLeadSource();
    setLocalStorage("Initial_Lead_Source", leadSource);
  }
}

// Function to attach the lead source to a form's hidden field before submission
function attachLeadSourceToFormSubmission() {
  const leadSource = getLocalStorage("Initial_Lead_Source");
  const leadSourceFields = document.querySelectorAll(".trk_lead_source input");

  if (leadSource && leadSourceFields.length) {
    leadSourceFields.forEach((field) => {
      field.value = leadSource;
    });
  }
}

// Main function to initialize tracking on page load
function initializeLeadSourceTracking() {
  document.addEventListener("DOMContentLoaded", function () {
    storeInitialLeadSource();
    attachLeadSourceToFormSubmission();
  });
}

// Run the initialization
initializeLeadSourceTracking();
