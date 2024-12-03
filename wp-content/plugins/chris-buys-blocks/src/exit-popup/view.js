
function exitPopupCallback() {
  let popupEls = document.querySelectorAll('.exit-popup:not(.is-initialized)')
  if(!popupEls){
    return;
  }
  popupEls.forEach(function (popupEl) {
    let popupId = popupEl.id
    let formName = popupEl.querySelector('form[name]') ? popupEl.querySelector('form[name]').name : 'no-name'
    let popupShown = false

    window.dataLayer = window.dataLayer || [];
    popupEl.classList.add('is-initialized')

    function showPopup() {
      popupShown = true;

      Fancybox.show([{
        src: '#'+popupId,
        type: 'inline',
        placeFocusBack: false,
        trapFocus: false,
        autoFocus: false,
      }], {
        dragToClose: false,
        on: {
          "destroy": (event, fancybox, slide) => {
            window.dataLayer.push({
              event: 'popup_close',
              popup_id: popupId
            });
          },
        }
      })
      window.dataLayer.push({
        event: 'popup_display',
        popup_id: popupId
      });
    }

    let prevY = 0
    document.addEventListener('mousemove', (event) => {
      if (!popupShown && event.clientY < prevY && event.clientY <= 5) {
        showPopup();
      }
      prevY = event.clientY
    });

    let touchStartY = 0;
    let touchStartTime = 0;
    const screenHeight = window.innerHeight;
    window.addEventListener('touchstart', function(e) {
      touchStartY = e.touches[0].clientY;
      touchStartTime = e.timeStamp;
    });
    window.addEventListener('touchend', function(e) {
      if (popupShown) return;

      const touchEndY = e.changedTouches[0].clientY;
      const touchEndTime = e.timeStamp;

      const deltaY = touchStartY - touchEndY; // Positive if scrolling up
      const deltaTime = touchEndTime - touchStartTime; // Time in ms

      const speed = deltaY / deltaTime; // Scroll speed in px/ms

      // Set thresholds
      const distanceThreshold = screenHeight * 0.3; // 20% of screen height
      const speedThreshold = .5; // px/ms

      if (deltaY < 0 && Math.abs(deltaY) > distanceThreshold && Math.abs(speed) > speedThreshold) {
        showPopup()
      }
    });

    popupEl.addEventListener('lead-form-interaction', function () {
      window.dataLayer.push({
        event: 'popup_interaction',
        popup_id: popupId,
        form_name: formName
      });
    })
    popupEl.addEventListener('lead-form-submit', function () {
      window.dataLayer.push({
        event: 'popup_submit',
        popup_id: popupId,
        form_name: formName
      });
    })
  })

}

document.addEventListener("DOMContentLoaded", function () {
  loadScript([
    'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js',
    'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css'
  ], exitPopupCallback);
});