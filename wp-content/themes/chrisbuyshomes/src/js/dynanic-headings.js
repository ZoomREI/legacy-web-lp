document.addEventListener("DOMContentLoaded", function () {
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
      h1: "Turn Your House Into Cash",
      h3: "Quick, Easy, and On Your Terms",
      h4: "Don’t worry about repairs or timing. Get a fair cash offer and close on your schedule. Discover hassle-free home selling!",
    },
    fast: {
      h1: "Need to Sell Your House Quickly?",
      h3: "We Will Buy It Fast, In Any Condition, With No Complications!",
      h4: "Say goodbye to long waiting periods and complex processes. We’re your quick, reliable solution for selling your home effortlessly.",
    },
    quick: {
      h1: "Need to Sell Your House Quickly?",
      h3: "We Will Buy It Fast, In Any Condition, With No Complications!",
      h4: "Say goodbye to long waiting periods and complex processes. We’re your quick, reliable solution for selling your home effortlessly.",
    },
    sell: {
      h1: "Selling Your House Has Never Been Easier - We Will Buy it Today!",
      h3: "Ready to move on? We’re here to help.",
      h4: "Sell your house now, on your timeline. Our quick process ensures you can sell your home fast and get on with your life.",
    },
    how: {
      h1: "Wondering How to Sell Your House?",
      h3: "We Will Buy It Fast, In Any Condition, With No Complications!",
      h4: "Get a cash offer with no fees and sell with confidence.",
    },
    "as is": {
      h1: "Sell Your House ‘As Is’ – Hassle-Free, Immediate Cash Offers!",
      h3: "Forget repairs and renovations; we buy your house as it stands.",
      h4: "Get a fair cash offer and sell your property on your terms, quickly and effortlessly.",
    },
    foreclosure: {
      h1: "Stop Foreclosure in Its Tracks – Sell Your Home Fast!",
      h3: "Don’t let foreclosure take away your peace of mind.",
      h4: "Act now and sell your house before it’s too late. We provide a quick sale solution to help you avoid foreclosure.",
    },
  };

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
    let h1Text = keywordMappings[keyword].h1;
    let h3Text = keywordMappings[keyword].h3;
    let h4Text = keywordMappings[keyword].h4;

    // Update the HTML elements
    document.querySelector("h1").innerHTML = h1Text;
    document.querySelector("h3").innerHTML = h3Text;
    document.querySelector("h4").innerHTML = h4Text;
  }
});
