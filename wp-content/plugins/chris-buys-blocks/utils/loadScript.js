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
  let shouldLoad = src.filter(item => !window.loadedScripts.includes(item.replace(/&callback=[^&]*/, '')));
  let hasCallbackInURL = src.find(item=>item.indexOf('&callback=') > -1)
  let allScriptsLoaded = src.every(script => window.fullyLoadedScripts.includes(script.replace(/&callback=[^&]*/, '')));

  if (allScriptsLoaded) {
    if(!hasCallbackInURL) {
      setTimeout(function () {
        callback();
      }, 10)
    }
    return;
  } else {
    let notFullyLoaded = src.map(item=>item.replace(/&callback=[^&]*/, '')).filter(item => !window.fullyLoadedScripts.includes(item));

    if(!notFullyLoaded.length){
      if(!hasCallbackInURL) {
        callback(true) // true - loaded before
      }
    } else {
      window.loadingQueue.push({
        scripts: src,
        callback: callback,
        hasCallbackInURL: hasCallbackInURL
      })
    }
  }

  window.loadedScripts = Array.from(new Set([...window.loadedScripts, ...shouldLoad.map(item=>item.replace(/&callback=[^&]*/, ''))]));

  shouldLoad.forEach(function (scriptSrc) {
    const script = document.createElement("script");

    script.type = "text/javascript";
    script.async = true;
    script.defer = true;
    script.onload = function() {
      window.fullyLoadedScripts.push(scriptSrc.replace(/&callback=[^&]*/, ''))

      if(window.loadingQueue.length){

        window.loadingQueue.forEach((item, index) => {
          if(item.loaded){
            return;
          }
          let thisAllScriptsLoaded = item.scripts.every(script => window.fullyLoadedScripts.includes(script.replace(/&callback=[^&]*/, '')));

          if (thisAllScriptsLoaded) {
            window.loadingQueue[index].loaded = true
            if(!item.hasCallbackInURL) {
              setTimeout(function () {
                item.callback(false);
              }, 10)
            }
          }
        });
      }
    };
    script.src = scriptSrc;
    document.body.appendChild(script);
  })
}
