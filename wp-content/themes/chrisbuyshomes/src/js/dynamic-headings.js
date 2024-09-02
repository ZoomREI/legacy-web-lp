document.addEventListener("DOMContentLoaded", function () {
  // Check if the cw-hero__titles element is present
  const titleWrapper = document.querySelector(".cw-hero__titles");
  if (!titleWrapper) {
    // Abort if the title wrapper is not found
    return;
  }

  // Function to get query parameters from the URL
  function getQueryParams() {
    let params = {};
    let queryString = window.location.search.substring(1);
    let regex = /([^&=]+)=([^&]*)/g;
    let m;
    while ((m = regex.exec(queryString))) {
      params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
    }
    return params;
  }

  // Get the parameters from the URL
  let params = getQueryParams();

  // Extract and normalize keywords from the content and kw parameters
  let contentKeywords = params["content"]
    ? decodeURIComponent(params["content"].toLowerCase())
    : "";
  let kwKeywords = params["kw"]
    ? decodeURIComponent(params["kw"].toLowerCase())
    : "";

  // Mapping of keywords to corresponding texts
  let keywordMappings = {
    cash: {
      mainTitle: "Turn Your House Into Cash",
      subtitle: "ANY Condition, On YOUR Timeline",
      paragraph:
        "Don’t worry about repairs or timing. Get a fair cash offer and close on your schedule. Discover hassle-free home selling!",
    },
    fast: {
      mainTitle: "Need to Sell Your House Quickly?",
      subtitle: "ANY Condition, With No Complications!",
      paragraph:
        "Say goodbye to long waiting periods and complex processes. We’re your quick, reliable solution for selling your home effortlessly.",
    },
    quick: {
      mainTitle: "Need to Sell Your House Quickly?",
      subtitle: "ANY Condition, With No Complications!",
      paragraph:
        "Say goodbye to long waiting periods and complex processes. We’re your quick, reliable solution for selling your home effortlessly.",
    },
    sell: {
      mainTitle:
        "Selling Your House Has Never Been Easier - We Will Buy it Today!",
      subtitle: "Ready to move on?",
      paragraph:
        "Sell your house now, on your timeline. Our quick process ensures you can sell your home fast and get on with your life.",
    },
    how: {
      mainTitle: "Wondering How to Sell Your House?",
      subtitle: "ANY Condition, With No Complications!",
      paragraph: "Get a cash offer with no fees and sell with confidence.",
    },
    "as is": {
      mainTitle:
        "Sell Your House ‘As Is’ – Hassle-Free, Immediate Cash Offers!",
      subtitle: "ANY Condition, On YOUR Timeline",
      paragraph:
        "Get a fair cash offer and sell your property on your terms, quickly and effortlessly.",
    },
    foreclosure: {
      mainTitle: "Stop Foreclosure in Its Tracks – Sell Your Home Fast!",
      subtitle: "ANY Condition, With No Complications!",
      paragraph:
        "Act now and sell your house before it’s too late. We provide a quick sale solution to help you avoid foreclosure.",
    },
  };

  // Function to find the matching keyword
  function findMatchingKeyword(originalKeywords) {
    // Split the keywords and handle special case for "as is"
    let keywordArray = originalKeywords.split(" ");

    // Join two-word keywords back together
    let joinedKeywords = [];
    for (let i = 0; i < keywordArray.length; i++) {
      if (keywordArray[i] === "as" && keywordArray[i + 1] === "is") {
        joinedKeywords.push("as is");
        i++; // Skip next word as it's part of the current keyword
      } else {
        joinedKeywords.push(keywordArray[i]);
      }
    }

    // Reverse the order to prioritize the last keyword found
    joinedKeywords.reverse();

    // Check each keyword individually in reversed order
    for (let keyword of joinedKeywords) {
      if (keywordMappings[keyword]) {
        return keyword;
      }
    }
    return null;
  }

  // First, check the content field for matching keywords
  let keyword = findMatchingKeyword(contentKeywords);

  // If no match is found in the content field, check the kw field
  if (!keyword) {
    keyword = findMatchingKeyword(kwKeywords);
  }

  if (keyword && Object.keys(keywordMappings).includes(keyword)) {
    let mainTitleText = keywordMappings[keyword].mainTitle;
    let subtitleText = keywordMappings[keyword].subtitle;
    let paragraphText = keywordMappings[keyword].paragraph;

    // Update the HTML elements if they exist within the cw-hero__titles
    let mainTitleElement = titleWrapper.querySelector("h1");
    let subtitleElement = titleWrapper.querySelector("h1 span");
    let paragraphElement = titleWrapper.querySelector("p");

    if (mainTitleElement)
      mainTitleElement.firstChild.textContent = mainTitleText;
    if (subtitleElement) subtitleElement.textContent = subtitleText;
    if (paragraphElement) paragraphElement.textContent = paragraphText;
  }
});
