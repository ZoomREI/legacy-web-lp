import { fadeIn, fadeOut, slideUp, slideDown } from "./modules/helpers";
import { validate } from "./modules/validate";
import { telInputMask } from "./modules/telInputMask";
import { inputSelect } from "./modules/inputSelect";


function leadFormCallback() {
    let leadForm = document.querySelector('.lead-form:not(.is-initialized)')
    if(!leadForm){
        return;
    }
    let leadFormConfig = JSON.parse(document.getElementById('form-config-'+leadForm.id).innerHTML)
    let phoneInput = leadForm.querySelector('[data-validation="tel-mask"]')

    leadForm.classList.add('is-initialized')

    console.log(JSON.stringify(leadFormConfig))
    function populateUtms(formData) {
        let utms = {
            'utm_source': 'utm',
            'utm_term': 'utm',
            'utm_campaign': 'utm',
            'utm_medium': 'utm',
            'utm_content': 'utm',
            'device': 'utm',
            'gclid': 'utm',
            'fbclid': 'utm',
            'msclkid': 'utm',
            'page_url': ()=>{
                return document.location.href
            },
            'lead_source': ()=>{
                return localStorage.getItem('Initial_Lead_Source') || ''
            },
            'timestamp': ()=>{
                return (new Date()).getTime()
            },
            'client_id': ()=>{
                return '??'
            },
            'session_id': ()=>{
                return '??'
            },
            'form_name': leadForm.name,
        }
        let getParams = new URLSearchParams(window.location.search)

        Object.keys(utms).forEach(function (utmName) {
            if(utms[utmName] === 'get'){
                if(getParams.get(utmName)) {
                    formData.set(utmName, getParams.get(utmName))
                }
            } else if(utms[utmName] === 'utm'){
                let utmFromQuery= getParams.get(utmName);
                let utmFromSession = sessionStorage.getItem(formConfig.storagePrefix + utmName);

                if(utmFromQuery) {
                    formData.set(utmName, utmFromQuery)
                } else if(utmFromSession){
                    formData.set(utmName, utmFromSession)
                }
            } else if(typeof utms[utmName] === 'function'){
                formData.set(utmName, utms[utmName]())
            } else {
                formData.set(utmName, utms[utmName])
            }
        })

        return formData;
    }
    function getRedirectParams(formData) {
        let query = {}

        leadFormConfig.query.forEach(function (fieldData) {
            let inputName = fieldData.field
            let propName = fieldData.key

            if(inputName === 'country'){
                query[propName] = 'United States'
            } else if(formData.get(inputName)) {
                query[propName] = formData.get(inputName)
            }
        })

        return new URLSearchParams(query).toString()
    }
    function sendAjax() {
        let xhr = new XMLHttpRequest();
        let formData = populateUtms(new FormData(leadForm));
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

        if (formBtn) {
            formBtn.classList.add('is-loading');
            formBtn.setAttribute('disabled', 'disabled');
        }

        formData.append('webhooks', JSON.stringify(leadFormConfig.webhooks))
        xhr.open('post', leadFormConfig.handler);
        xhr.onload = function() {
            if (xhr.status === 200) {
                if(leadFormConfig.redirect) {
                    let redirectParams = getRedirectParams(formData)

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
}

window.leadFormCallback = leadFormCallback


function sessionStorageUTM() {
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
                sessionStorage.setItem(formConfig.storagePrefix + key, params[key]);
            }
        }
    }

    if (Object.keys(getQueryParams()).length > 0) {
        storeParams(getQueryParams());
    }
}
document.addEventListener("DOMContentLoaded", function () {
    sessionStorageUTM()
    loadScript(`https://maps.googleapis.com/maps/api/js?key=${formConfig.googleMapsApiKey}&libraries=places`, leadFormCallback);
});