document.addEventListener("DOMContentLoaded",(()=>{[].slice.call(document.querySelectorAll('a[href*="#"]')).forEach((function(e){e.addEventListener("click",(function(t){t.preventDefault();let n=document.querySelector(e.getAttribute("href")).getBoundingClientRect().top+window.pageYOffset,o=setInterval((function(){let e=n/20;e>window.pageYOffset-n&&window.innerHeight+window.pageYOffset<document.body.offsetHeight?window.scrollBy(0,e):(window.scrollTo(0,n),clearInterval(o))}),25)}))}))}));