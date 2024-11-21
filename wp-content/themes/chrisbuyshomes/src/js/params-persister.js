(function () {
  const storagePrefix = "chrisbuys_";

  const paramsMap = {
    utm_source: "source",
    utm_campaign: "campaign",
    utm_term: "keyword",
    utm_medium: "medium",
    utm_content: "content",
    device: "device",
    gclid: "gclid",
    fbclid: "fbclid",
    msclkid: "msclkid",
  };

  function getQueryParams() {
    const query = window.location.search.substring(1);
    const vars = query.split("&");
    const queryParams = {};
    for (let i = 0; i < vars.length; i++) {
      const pair = vars[i].split("=");
      if (pair.length > 0) {
        const paramName = decodeURIComponent(pair[0]);
        const paramValue = decodeURIComponent(pair[1] || "");
        if (paramsMap.hasOwnProperty(paramName)) {
          const standardizedKey = paramsMap[paramName];
          if (!queryParams.hasOwnProperty(standardizedKey)) {
            queryParams[standardizedKey] = paramValue;
          }
        }
      }
    }
    return queryParams;
  }

  function storeParams(params) {
    for (const key in params) {
      if (params.hasOwnProperty(key)) {
        sessionStorage.setItem(storagePrefix + key, params[key]);
      }
    }
  }

  document.addEventListener("DOMContentLoaded", function () {
    const queryParams = getQueryParams();
    if (Object.keys(queryParams).length > 0) {
      storeParams(queryParams);
    }
  });
})();
