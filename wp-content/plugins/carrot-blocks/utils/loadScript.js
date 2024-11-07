function loadScript(src, callback = ()=>{}) {
  if(typeof window.loadedScripts === 'undefined') {
    window.loadedScripts = [];
  }
  if(typeof window.fullyLoadedScripts === 'undefined') {
    window.fullyLoadedScripts = [];
  }
  if(typeof window.loadingQueue === 'undefined') {
    window.loadingQueue = [];
  }
  if(typeof src === 'string'){
    src = [src];
  }
  console.log("1. Appending script:", src);
  let loadedScripts = 0;
  let shouldLoad = src.filter(item => !window.loadedScripts.includes(item));
  let shouldLoadCount = shouldLoad.length
  let hasCallbackInURL = false

  console.log("2. Not loaded before:", shouldLoad);

  if(!shouldLoadCount){
    let notFullyLoaded = src.filter(item => !window.fullyLoadedScripts.includes(item));

    if(!notFullyLoaded.length){
      callback(true) // true - loaded before
    } else {
      window.loadingQueue.push({
        scripts: src,
        callback: callback
      })
    }

    return;
  }

  window.loadedScripts = Array.from(new Set([...window.loadedScripts, ...shouldLoad]));

  shouldLoad.forEach(function (scriptSrc) {
    const script = document.createElement("script");

    if(scriptSrc.indexOf('callback=') > -1){
      hasCallbackInURL = true
    }
    script.type = "text/javascript";
    script.async = true;
    script.defer = true;
    script.onload = function() {
      loadedScripts++

      if(loadedScripts === shouldLoadCount) {
        console.log("3. Scripts loaded.", shouldLoad);

        window.fullyLoadedScripts = Array.from(new Set([...window.fullyLoadedScripts, ...shouldLoad]));

        if(!hasCallbackInURL) {
          callback(false) // false - not loaded before
        }
        if(window.loadingQueue.length){
          window.loadingQueue.forEach(item => {
            const allScriptsLoaded = item.scripts.every(script => window.fullyLoadedScripts.includes(script));

            if (allScriptsLoaded) {
              item.callback(false);
            }
          });
        }
      }
    };
    script.src = scriptSrc;
    document.body.appendChild(script);
  })
}
