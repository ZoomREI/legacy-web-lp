
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
        popupShown = true;
        showPopup();
      }
      prevY = event.clientY
    });
    window.addEventListener('beforeunload', (event) => {
      if (!popupShown) {
        popupShown = true;
        showPopup();

        event.preventDefault();
        event.returnValue = 'Don’t leave without a cash offer!';
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