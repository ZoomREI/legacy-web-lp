import { fadeIn, fadeOut, slideUp, slideDown, sessionStorageUTM, trigger } from "./modules/helpers";
import { populateUtms, getRedirectParams } from "./modules/form_helpers";
import { validate } from "./modules/validate";
import { telInputMask } from "./modules/telInputMask";
import { inputSelect } from "./modules/inputSelect";


function leadFormCallback() {
    let leadForms = document.querySelectorAll('.lead-form:not(.is-initialized)')
    if(!leadForms.length){
        return;
    }
    leadForms.forEach(function (leadForm) {
        let leadFormConfig = JSON.parse(document.getElementById('form-config-'+leadForm.id).innerHTML)
        let phoneInput = leadForm.querySelector('[data-validation="tel-mask"]')

        leadForm.classList.add('is-initialized')

        function sendAjax() {
            let xhr = new XMLHttpRequest();
            let formData = populateUtms(leadForm, new FormData(leadForm));
            let formBtn = leadForm.querySelector('[type="submit"]');

            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: "submitStep1",
                formName: leadForm.name,
                fullName: formData.get('fullName'),
                street: formData.get('street'),
                city: formData.get('city'),
                state: formData.get('state'),
                country: "US",
                zipcode: formData.get('zipcode'),
                email: formData.get('email'),
                phone: formData.get('phone')
            });
            trigger(leadForm, 'lead-form-submit')

            if (formBtn) {
                formBtn.classList.add('is-loading');
                formBtn.setAttribute('disabled', 'disabled');
            }

            formData.append('webhooks', JSON.stringify(leadFormConfig.webhooks))
            xhr.open('post', leadFormConfig.handler);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    if(leadFormConfig.redirect) {
                        let redirectParams = getRedirectParams(formData, leadFormConfig.query)

                        document.location.href = leadFormConfig.redirect + (redirectParams ? '?'+redirectParams : '')
                    }
                }
            };
            xhr.send(formData);
        }
        function initAddress() {
            let addressInput = leadForm.querySelector('[data-validation="address-autocomplete"]')
            let addressInputBtn = leadForm.querySelector('[type="submit"]')
            let autocomplete = new google.maps.places.Autocomplete(addressInput, {
                types: ["address"],
                componentRestrictions: { country: "us" },
            });
            let inputStreet = leadForm.querySelector('[name="street"]')
            let inputCity = leadForm.querySelector('[name="city"]')
            let inputState = leadForm.querySelector('[name="state"]')
            let inputZipcode = leadForm.querySelector('[name="zipcode"]')

            addressInput.autocompleteInstance = autocomplete
            autocomplete.addListener("place_changed", function () {
                if(addressInput.isValid()){
                    inputStreet.value = addressInput.dataset.street
                    inputCity.value = addressInput.dataset.city
                    inputState.value = addressInput.dataset.state
                    inputZipcode.value = addressInput.dataset.zipcode
                }
                trigger(leadForm, 'lead-form-interaction')
            });
            if(addressInputBtn) {
                addressInputBtn.addEventListener('click', function (e) {
                    addressInput.closest('.input').classList.remove('is-error')
                })
            }
        }

        telInputMask(phoneInput, {
            mask: '(xxx) xxx - xxxx',
            hiddenInput: true
        })
        validate(leadForm, {
            submitFunction: sendAjax,
            trackErrors: true
        })
        initAddress()
        inputSelect()
    })
}

document.addEventListener("DOMContentLoaded", function () {
    sessionStorageUTM()
    console.log()
    loadScript(`https://maps.googleapis.com/maps/api/js?key=${formConfig.googleMapsApiKey}&libraries=places`, leadFormCallback);
});