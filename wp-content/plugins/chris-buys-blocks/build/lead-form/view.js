/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/lead-form/modules/form_helpers.js":
/*!***********************************************!*\
  !*** ./src/lead-form/modules/form_helpers.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getRedirectParams: () => (/* binding */ getRedirectParams),
/* harmony export */   populateUtms: () => (/* binding */ populateUtms)
/* harmony export */ });
function populateUtms(form, formData) {
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
    'page_url': () => {
      return document.location.href;
    },
    'lead_source': () => {
      return localStorage.getItem('Initial_Lead_Source') || '';
    },
    'timestamp': () => {
      return new Date().getTime();
    },
    'client_id': () => {
      return '??';
    },
    'session_id': () => {
      return '??';
    },
    'form_name': form.name
  };
  let getParams = new URLSearchParams(window.location.search);
  Object.keys(utms).forEach(function (utmName) {
    if (utms[utmName] === 'get') {
      if (getParams.get(utmName)) {
        formData.set(utmName, getParams.get(utmName));
      }
    } else if (utms[utmName] === 'utm') {
      let utmFromQuery = getParams.get(utmName);
      let utmFromSession = sessionStorage.getItem(formConfig.storagePrefix + utmName);
      if (utmFromQuery) {
        formData.set(utmName, utmFromQuery);
      } else if (utmFromSession) {
        formData.set(utmName, utmFromSession);
      }
    } else if (typeof utms[utmName] === 'function') {
      formData.set(utmName, utms[utmName]());
    } else {
      formData.set(utmName, utms[utmName]);
    }
  });
  return formData;
}
function getRedirectParams(formData, queries) {
  let query = {};
  queries.forEach(function (fieldData) {
    let inputName = fieldData.field;
    let propName = fieldData.key;
    if (inputName === 'country') {
      query[propName] = 'United States';
    } else if (formData.get(inputName)) {
      query[propName] = formData.get(inputName);
    }
  });
  return new URLSearchParams(query).toString();
}

/***/ }),

/***/ "./src/lead-form/modules/helpers.js":
/*!******************************************!*\
  !*** ./src/lead-form/modules/helpers.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   dynamicListener: () => (/* binding */ dynamicListener),
/* harmony export */   fadeIn: () => (/* binding */ fadeIn),
/* harmony export */   fadeOut: () => (/* binding */ fadeOut),
/* harmony export */   sessionStorageUTM: () => (/* binding */ sessionStorageUTM),
/* harmony export */   slideDown: () => (/* binding */ slideDown),
/* harmony export */   slideUp: () => (/* binding */ slideUp),
/* harmony export */   trigger: () => (/* binding */ trigger)
/* harmony export */ });
function dynamicListener(events, selector, handler, context) {
  events.split(' ').forEach(function (event) {
    (document || context).addEventListener(event, function (e) {
      if (e.target.matches(selector) || e.target.closest(selector)) {
        handler.call(e.target.closest(selector), e);
      }
    });
  });
}
function trigger(el, eventName, params = {}) {
  let thisEl = el;
  let thisEventName = eventName;
  let thisParams = params;
  if (typeof el === 'string') {
    thisEventName = el;
    thisEl = document;
    if (typeof eventName === 'object') {
      thisParams = eventName;
    }
  }
  let newEvent = new CustomEvent(thisEventName, {
    bubbles: true,
    detail: thisParams
  });
  thisEl.dispatchEvent(newEvent);
}
function animateHeight(element, duration, startHeight, targetHeight, onComplete) {
  let elStyles = window.getComputedStyle(element);
  let paddingTop = elStyles.paddingTop.replace('px', '');
  let paddingBottom = elStyles.paddingBottom.replace('px', '');
  if (!startHeight) {
    startHeight = element.clientHeight;
  }
  let currentHeight = startHeight;
  element.style.transition = '';
  if (targetHeight) {
    if (paddingTop) {
      startHeight -= paddingTop;
      element.style.paddingTop = '0';
      setTimeout(function () {
        element.style.transition = `padding ${duration}ms linear`;
        element.style.paddingTop = paddingTop + 'px';
      }, 10);
    }
    if (paddingBottom) {
      startHeight -= paddingBottom;
      element.style.paddingBottom = '0px';
      setTimeout(function () {
        element.style.transition = `padding ${duration}ms linear`;
        element.style.paddingBottom = paddingBottom + 'px';
      }, 10);
    }
    currentHeight = startHeight;
  } else {
    if (paddingTop) {
      element.style.transition = `padding ${duration}ms linear`;
      element.style.paddingTop = '0px';
    }
    if (paddingBottom) {
      element.style.transition = `padding ${duration}ms linear`;
      element.style.paddingBottom = '0px';
    }
  }
  if (startHeight / targetHeight !== Infinity) {
    duration = duration - duration * (startHeight / targetHeight);
  }
  if (element.animation && element.animation.stop) {
    element.animation.stop();
  }
  function updateHeight() {
    const elapsedTime = performance.now() - startTime;
    const progress = Math.min(1, elapsedTime / duration);
    currentHeight = startHeight + progress * (targetHeight - startHeight);
    element.style.height = currentHeight.toFixed(2) + 'px';
    if (progress < 1) {
      element.animation.raf = requestAnimationFrame(updateHeight);
    } else {
      element.style.height = '';
      element.style.paddingTop = '';
      element.style.paddingBottom = '';
      element.style.overflow = '';
      element.style.transition = '';
      element.animation = false;
      if (!targetHeight) {
        element.style.display = 'none';
      }
      if (onComplete) {
        onComplete();
      }
    }
  }
  function stopAnimation() {
    cancelAnimationFrame(element.animation.raf);
  }
  const startTime = performance.now();
  element.animation = {
    raf: 0,
    type: targetHeight > startHeight ? 'slideDown' : 'slideUp',
    stop: stopAnimation
  };
  updateHeight();
}
function slideDown(element, duration, display = 'block', onComplete) {
  let startHeight = element.clientHeight;
  element.style.display = display;
  element.style.height = 'unset';
  const targetHeight = element.clientHeight;
  element.style.height = '0px';
  element.style.overflow = 'hidden';
  animateHeight(element, duration, startHeight, targetHeight, onComplete);
}
function slideUp(element, duration, onComplete) {
  const targetHeight = 0;
  element.style.overflow = 'hidden';
  animateHeight(element, duration, false, targetHeight, onComplete);
}
function animateOpacity(element, duration, display = 'block', targetOpacity, onComplete) {
  const elStyles = window.getComputedStyle(element);
  const startOpacity = elStyles.display === 'none' ? 0 : parseFloat(elStyles.opacity);
  let currentOpacity = startOpacity;
  if (startOpacity !== 1) {
    duration = duration - duration * startOpacity;
  }
  if (targetOpacity) {
    element.style.opacity = startOpacity;
    element.style.display = display;
  }
  if (element.animation && element.animation.stop) {
    element.animation.stop();
  }
  function updateOpacity() {
    const elapsedTime = performance.now() - startTime;
    const progress = Math.min(1, elapsedTime / duration);
    currentOpacity = startOpacity + progress * (targetOpacity - startOpacity);
    element.style.opacity = currentOpacity.toFixed(2);
    if (progress < 1) {
      element.animation.raf = requestAnimationFrame(updateOpacity);
    } else {
      element.style.opacity = '';
      element.animation = false;
      if (!targetOpacity) {
        element.style.display = 'none';
      }
      if (onComplete) {
        onComplete();
      }
    }
  }
  function stopAnimation() {
    cancelAnimationFrame(element.animation.raf);
  }
  const startTime = performance.now();
  element.animation = {
    raf: 0,
    type: targetOpacity ? 'fadeIn' : 'fadeOut',
    stop: stopAnimation
  };
  updateOpacity();
}
function fadeIn(el, timeout, display = 'block', afterFunc = false) {
  animateOpacity(el, timeout, display, 1, afterFunc);
}
function fadeOut(el, timeout, afterFunc = false) {
  animateOpacity(el, timeout, '', 0, afterFunc);
}
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
    msclkid: "msclkid"
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

/***/ }),

/***/ "./src/lead-form/modules/inputSelect.js":
/*!**********************************************!*\
  !*** ./src/lead-form/modules/inputSelect.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   dropdown: () => (/* binding */ dropdown),
/* harmony export */   inputSelect: () => (/* binding */ inputSelect)
/* harmony export */ });
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helpers */ "./src/lead-form/modules/helpers.js");

function dropdown(options) {
  let opts = {
    globalContainer: '',
    containerClass: 'header__lang',
    btnSelector: '.header__lang-btn',
    closeBtnClass: '',
    dropdownSelector: '.header__lang-dropdown',
    timing: 300,
    effect: 'slide',
    closeOnClick: true,
    closeOnClickOutside: true
  };
  let timing = 300;
  opts = {
    ...opts,
    ...options
  };
  let openTimeout = false;
  function open(e) {
    e.preventDefault();
    let container = e.target.closest('.' + opts.containerClass);
    let thisDropdown = container.querySelector(opts.dropdownSelector);
    if (openTimeout) {
      return;
    }
    setTimeout(function () {
      openTimeout = false;
    }, 200);
    openTimeout = true;
    if (container.classList.contains('is-open')) {
      close();
      return;
    }
    if (e.type === 'focusin') {
      container.classList.add('focusin');
    }
    if (e.type !== 'focusin') {
      container.classList.remove('focusin');
    }
    close(container);
    container.classList.add('is-open');
    container.style.zIndex = '4';
    if (opts.effect === 'fade') {
      (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.fadeIn)(thisDropdown, timing);
    } else if (opts.effect === 'slide') {
      (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.slideDown)(thisDropdown, timing);
    } else {
      console.error('Dropdown plugin: There is no effect called "' + opts.effect + '". Effects: "slide", "fade".');
    }
  }
  function close(dontClose) {
    let dropdownsToClose = document.querySelectorAll('.' + opts.containerClass);
    if (dontClose) {
      dropdownsToClose = Array.from(dropdownsToClose).filter(item => item !== dontClose);
    }
    if (!dropdownsToClose.length) {
      return;
    }
    dropdownsToClose.forEach(function (dropdownToClose) {
      if (!dropdownToClose.classList.contains('is-open')) {
        return;
      }
      dropdownToClose.classList.remove('is-open');
      dropdownToClose.querySelectorAll('li').forEach(item => item.classList.remove('hover'));
      dropdownToClose.style.zIndex = '';
      if (opts.effect === 'fade') {
        (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.fadeOut)(dropdownToClose.querySelector(opts.dropdownSelector), timing);
      } else if (opts.effect === 'slide') {
        (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.slideUp)(dropdownToClose.querySelector(opts.dropdownSelector), timing);
      } else {
        console.error('Dropdown plugin: There is no effect called "' + opts.effect + '". Effects: "slide", "fade".');
      }
    });
  }
  if (opts.closeOnClickOutside) {
    document.addEventListener('click', function (e) {
      let thisEl = e.target;
      if (opts.closeBtnClass ? thisEl.classList.contains(opts.closeBtnClass) : false) {
        close();
      }
      if (!thisEl.classList.contains(opts.containerClass) && !thisEl.closest('.' + opts.containerClass)) {
        close();
      }
    });
  }
  (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.dynamicListener)('click', opts.globalContainer + ' .' + opts.containerClass + ' ' + opts.btnSelector, open);
  (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.dynamicListener)('focusin', opts.globalContainer + ' .' + opts.containerClass + ' ' + opts.btnSelector, open);
  (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.dynamicListener)('focusout', opts.globalContainer + ' .' + opts.containerClass + ' ' + opts.btnSelector, function (e) {
    e.target.closest('.' + opts.containerClass).classList.remove('focusin');
    close(e.target.closest('.' + opts.containerClass));
  });
  document.addEventListener('close-dropdown', close);
  if (opts.timing !== false) {
    timing = opts.timing;
  }
  if (opts.containerClass === 'select') {
    timing = 0;
  }
  if (opts.closeOnClick) {
    (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.dynamicListener)('click', opts.globalContainer + ' .' + opts.containerClass + ' ' + opts.dropdownSelector, function (e) {
      if (!e.target.closest('.' + opts.containerClass).classList.contains('checkbox')) {
        close();
      }
    });
  }
}
function inputSelect() {
  dropdown({
    globalContainer: '',
    containerClass: 'input--select',
    btnSelector: '.output_text',
    closeBtnClass: '',
    dropdownSelector: '.input__dropdown',
    effect: 'slide',
    timing: 200
  });
  function selectItem(e) {
    let option = e.target.closest('li');
    let container = option.closest('.input--select');
    let text = option.textContent.trim();
    let value = option.dataset.value;
    let outText = container.querySelector('.output_text');
    let outValue = container.querySelector('.output_value');
    if (outText) {
      outText.value = text || outText.placeholder;
    }
    if (outValue) {
      outValue.value = value;
      if (typeof outValue.isValid === 'function') {
        outValue.isValid();
      }
    }
    option.classList.add('is-selected');
    Array.from(option.parentElement.children).forEach(function (item) {
      if (item != option) {
        item.classList.remove('is-selected');
      }
    });
    if (!container.classList.contains('has-checkbox')) {
      (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.trigger)('close-dropdown');
    }
  }
  (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.dynamicListener)('click', '.input--select li', selectItem);
  document.querySelectorAll('.input--select [data-value].is-selected').forEach(function (item) {
    selectItem({
      target: item
    });
  });
}

/***/ }),

/***/ "./src/lead-form/modules/telInputMask.js":
/*!***********************************************!*\
  !*** ./src/lead-form/modules/telInputMask.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   telInputMask: () => (/* binding */ telInputMask)
/* harmony export */ });
function telInputMask(input, newOpts = {}) {
  let defaultOpts = {
    chars: {
      number: 'x',
      letter: 'a'
    },
    placeholders: {
      number: '_',
      letter: 'x'
    },
    hiddenInput: false,
    mask: '+38 0xx xxx-xx-xx',
    clearOnBlur: true,
    showOnFocus: true,
    onFilled: (unmaskedValue, maskedValue) => {}
  };
  let opts = {
    ...defaultOpts,
    ...newOpts
  };
  if (!opts.mask) {
    return;
  }
  let maskArray = opts.mask.split('');
  let firstFillableChar = 0;
  maskArray.find((item, index) => {
    let isFillable = isMaskCharFillable(item).isFillable;
    if (isFillable) {
      firstFillableChar = index;
    }
    return isFillable;
  });
  if (opts.hiddenInput) {
    let hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = input.name;
    input.name = input.name + '_masked';
    input.hiddenInput = hiddenInput;
    input.insertAdjacentElement('afterend', hiddenInput);
    hiddenInput.value = getUnmaskedValue(input.value);
    if (opts.hiddenInput.mask) {
      onInput.call(hiddenInput, opts.hiddenInput.mask);
    }
  }
  function getUnmaskedValue(maskedString, mask = opts.mask) {
    let result = '';
    let maskIndex = 0;
    let maskedIndex = 0;
    maskedString = maskedString.replaceAll(opts.placeholders.number, '').replaceAll(opts.placeholders.letter, '').replaceAll(' ', '');
    while (maskIndex < mask.length && maskedIndex < maskedString.length) {
      if (mask[maskIndex] === 'x') {
        if (/\d/.test(maskedString[maskedIndex])) {
          result += maskedString[maskedIndex];
        }
        maskedIndex++;
      } else if (mask[maskIndex] === 'a') {
        if (/[A-Za-zА-Яа-яІіЇїЄєҐґ]/.test(maskedString[maskedIndex])) {
          result += maskedString[maskedIndex];
        }
        maskedIndex++;
      } else {
        if (mask[maskIndex] === maskedString[maskedIndex]) {
          maskedIndex++;
        }
      }
      maskIndex++;
    }
    return result;
  }
  function isCharFillable(char) {
    let returnArray = {};
    returnArray.number = /\d/.test(char);
    returnArray.letter = /[A-Za-zА-Яа-яІіЇїЄєҐґ]/.test(char);
    returnArray.isFillable = returnArray.number || returnArray.letter;
    return returnArray;
  }
  function isMaskCharFillable(char) {
    let returnArray = {};
    returnArray.number = char === opts.chars.number;
    returnArray.letter = char === opts.chars.letter;
    returnArray.isFillable = returnArray.number || returnArray.letter;
    return returnArray;
  }
  function onInput(mask = opts.mask) {
    let thisValue = this.type !== 'hidden' ? getUnmaskedValue(this.value, mask).split('') : this.value.split('');
    let finalValue = '';
    let count = 0;
    let thisMaskArray = this.type !== 'hidden' ? maskArray : mask.split('');
    thisValue.forEach(function (valueChar, index) {
      let fillableChar = isCharFillable(valueChar);
      if (!fillableChar.isFillable) {
        return;
      }
      let fillableMaskChar;
      while (count < thisMaskArray.length) {
        fillableMaskChar = isMaskCharFillable(thisMaskArray[count]);
        if (fillableMaskChar.isFillable) {
          break;
        }
        finalValue += thisMaskArray[count];
        count++;
      }
      if (fillableMaskChar.number && fillableChar.number || fillableMaskChar.letter && fillableChar.letter) {
        finalValue += valueChar;
      }
      count++;
    });
    let finalValueLength = finalValue.length;
    for (let i = finalValue === '' ? 0 : finalValue.length; i < mask.length; i++) {
      if (mask[i] === opts.chars.number) {
        finalValue += opts.placeholders ? opts.placeholders.number : '';
      } else if (mask[i] === opts.chars.letter) {
        finalValue += opts.placeholders ? opts.placeholders.letter : '';
      } else {
        finalValue += mask[i];
      }
    }
    this.value = finalValue;
    if (this.type !== 'hidden') {
      if (finalValueLength) {
        this.setSelectionRange(finalValueLength, finalValueLength);
      } else {
        this.setSelectionRange(firstFillableChar, firstFillableChar);
      }
      if (this.hiddenInput) {
        this.hiddenInput.value = getUnmaskedValue(this.value);
        if (opts.hiddenInput.mask) {
          onInput.call(this.hiddenInput, opts.hiddenInput.mask);
        }
      }
    }
    if (this.value.replaceAll(opts.placeholders.number, '').replaceAll(opts.placeholders.letter, '').length === mask.length) {
      let unmaskedValue = getUnmaskedValue(this.value);
      opts.onFilled(unmaskedValue, this.value);
    }
  }
  input.getUnmaskedValue = () => {
    return getUnmaskedValue(input.value);
  };
  input.isFilled = () => {
    return input.value.replaceAll(opts.placeholders.number, '').replaceAll(opts.placeholders.letter, '').length === opts.mask.length;
  };
  input.addEventListener('input', function () {
    onInput.call(this);
  });
  if (opts.showOnFocus) {
    input.addEventListener('focus', function () {
      onInput.call(this);
    });
  }
  if (opts.clearOnBlur) {
    input.addEventListener('blur', function () {
      if (!getUnmaskedValue(this.value)) {
        this.value = '';
      }
    });
  }
}

/***/ }),

/***/ "./src/lead-form/modules/validate.js":
/*!*******************************************!*\
  !*** ./src/lead-form/modules/validate.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   validate: () => (/* binding */ validate)
/* harmony export */ });
const only_num = /^[0-9.]+$/;
const only_num_replace = /[^0-9.]/g;
const email_reg = /^(([^<>()\[\]\\.,;:\s@"]{2,62}(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z-аА-яЯ\-0-9]+\.)+[a-zA-Z-аА-яЯ]{2,62}))$/;
const validationRules = {
  'email': {
    'rules': {
      regex: email_reg
    }
  },
  'numeric': {
    'rules': {
      regex: only_num
    }
  },
  'numeric-replace': {
    'rules': {
      regexReplace: only_num_replace
    }
  },
  'address-autocomplete': {
    'rules': {
      addressAutocomplete: true
    }
  },
  'tel-mask': {
    'rules': {
      telMask: true
    }
  }
};
const validationMethods = {
  "addressAutocomplete": function (_, autocompleteField) {
    if (!autocompleteField.autocompleteInstance) {
      return true;
    }
    if (!autocompleteField.value.trim()) {
      if (autocompleteField.closest('.is-error')) {
        return;
      }
      autocompleteField.dataset.validity = "Please re-enter and select your address from the dropdown";
      autocompleteField.setCustomValidity(autocompleteField.dataset.validity);
      autocompleteField.reportValidity();
      return false;
    }
    const place = autocompleteField.autocompleteInstance.getPlace();
    if (!place || !place.geometry) {
      if (autocompleteField.closest('.is-error')) {
        return;
      }
      autocompleteField.dataset.validity = "Address must include a street number";
      autocompleteField.setCustomValidity(autocompleteField.dataset.validity);
      autocompleteField.reportValidity();
      return false;
    }
    let streetAddress = "";
    let city = "";
    let stateShort = "";
    let stateLong = "";
    let zipcode = "";
    let hasStreetNumber = false;
    for (const component of place.address_components) {
      const componentType = component.types[0];
      switch (componentType) {
        case "street_number":
          streetAddress = component.long_name;
          hasStreetNumber = true;
          break;
        case "route":
          streetAddress += " " + component.long_name;
          break;
        case "locality":
          city = component.long_name;
          break;
        case "administrative_area_level_1":
          stateShort = component.short_name;
          stateLong = component.long_name;
          break;
        case "postal_code":
          zipcode = component.long_name;
          break;
      }
    }
    if (!hasStreetNumber) {
      if (autocompleteField.closest('.is-error')) {
        return;
      }
      autocompleteField.dataset.validity = "Address must include a street number";
      autocompleteField.setCustomValidity(autocompleteField.dataset.validity);
      autocompleteField.reportValidity();
      return false;
    }
    autocompleteField.dataset.validity = '';
    autocompleteField.setCustomValidity('');
    autocompleteField.dataset.error = '';
    autocompleteField.dataset.street = streetAddress;
    autocompleteField.dataset.city = city;
    autocompleteField.dataset.state = stateLong;
    autocompleteField.dataset.zipcode = zipcode;
    autocompleteField.value = `${streetAddress}, ${city}, ${stateShort}, ${zipcode}`;
    return true;
  },
  "telMask": function (_, input) {
    return !input.required || input.isFilled();
  }
};
function validate(form, newOpts = {}) {
  let defaultOpts = {
    methodsOnInput: ['regexReplace', 'maxlength'],
    submitFunction: null,
    highlightFunction: null,
    unhighlightFunction: null,
    checkOnInput: false,
    checkOnInputAfterSubmit: false,
    checkOnFocusOut: true,
    disableButton: false,
    errorClass: 'is-error',
    dontValidateInputs: 'input:not([type="hidden"])[name], .output_value, select, textarea',
    inputContainerSelector: '.input',
    formErrorBlock: '',
    addInputErrors: true,
    trackErrors: false,
    validationRules: typeof validationRules !== 'undefined' ? validationRules : {},
    validationErrors: typeof validationErrors !== 'undefined' ? validationErrors : {},
    methods: {
      "regex": function (value, element, regexp) {
        return value == '' || new RegExp(regexp).test(value);
      },
      "required": function (value, input) {
        if (input.getAttribute('type') === 'checkbox' || input.getAttribute('type') === 'radio') {
          let elseInputs = Array.from(form.querySelectorAll(`[name="${input.getAttribute('name')}"]`));
          let hasChecked = !!elseInputs.find(item => item.checked);
          if (hasChecked) {
            elseInputs.forEach(function (elseInput) {
              if (typeof elseInput.removeError === 'function') {
                elseInput.removeError();
              }
            });
          }
          return hasChecked;
        } else {
          return !!value.trim();
        }
      },
      "regexReplace": function (value, element, regexp) {
        element.value = element.value.replace(new RegExp(regexp), "");
        return true;
      },
      "password_repeat": function (value, element, regexp) {
        let password = element.closest('form').querySelector('[data-validation="password"]');
        return !element.hasAttribute('required') && !value || value === password.value;
      },
      "tel_mask": function (value, element, regexp) {
        if (typeof element['checkValidCallback'] !== 'undefined') {
          element.checkValidCallback();
        }
        return typeof element['telMask'] !== 'undefined' ? element['telMask'].isValidNumber() || value === '' : true;
      },
      "minlength": function (value, element, passedValue) {
        let min = passedValue || +element.getAttribute("minlength");
        if (!min || !value) return true;
        return value.length >= min;
      },
      "maxlength": function (value, element, regexp) {
        let max = +element.getAttribute("maxlength");
        if (!max) return true;
        if (element.value.length > max) {
          element.value = element.value.substr(0, max);
        }
        return true;
      }
    }
  };
  let opts = {
    ...defaultOpts,
    ...newOpts
  };
  if (typeof validationMethods === 'object') {
    opts["methods"] = {
      ...opts["methods"],
      ...validationMethods
    };
  }
  if (typeof form === 'string') form = document.querySelector(form);
  function selectAll(selector, container = false) {
    return Array.from(!container ? document.querySelectorAll(selector) : container.querySelectorAll(selector));
  }
  function printf(string, vars = [], addToEnd = true, char = '&') {
    vars.forEach(function (thisVar, index) {
      let r = new RegExp(char + (index + 1) + '(?![0-9])', 'g');
      if (r.test(string)) {
        string = string.replace(r, thisVar);
      } else if (addToEnd) {
        string += ' ' + thisVar;
      }
    });
    return string;
  }
  function getMethodError(input, methodName, defaultText, variable = []) {
    let dataValidation = input.getAttribute('data-validation');
    let errorMessage = printf(defaultText, variable);
    if (opts.validationErrors[methodName]) {
      errorMessage = printf(opts.validationErrors[methodName], variable);
    }
    if (opts.validationErrors[dataValidation] && opts.validationErrors[dataValidation][methodName]) {
      errorMessage = printf(opts.validationErrors[dataValidation][methodName], variable);
    }
    return errorMessage;
  }
  function formSubmitListener(e) {
    e.preventDefault();
    _this.validate();
    _this.formSubmitted = true;
  }
  function inputInputListener(e) {
    this['had_input'] = true;
    this.dataset.validity = '';
    this.setCustomValidity("");
    if (!opts.checkOnInput && !opts.checkOnInputAfterSubmit) {
      return;
    }
    if (opts.disableButton) {
      _this.checkDisableButton();
    }
    if (opts.methodsOnInput.length) {
      _this.valid(this, opts.methodsOnInput);
      return;
    }
    if (opts.checkOnFocusOut && input['had_focusout']) {
      _this.valid(this);
      return;
    }
    if (opts.checkOnInput) {
      _this.valid(this);
      return;
    }
    if (opts.checkOnInputAfterSubmit && _this.formSubmitted) {
      _this.valid(this);
    }
    let inputsSameName = Array.from(form.querySelectorAll(`[name="${this.getAttribute('name')}"]`));
    if (inputsSameName.length > 1) {
      let isTypesSame = !inputsSameName.find(item => item.getAttribute('type') !== inputsSameName[0].getAttribute('type'));
      let hasRequired = inputsSameName.find(item => typeof item.getAttribute('required') !== 'undefined');
      if (!isTypesSame && hasRequired) {
        if (this.getAttribute('type') !== 'checkbox' && this.getAttribute('type') !== 'radio') {
          let diffInputs = inputsSameName.filter(item => item.getAttribute('type') !== this.getAttribute('type'));
          if (diffInputs.length) {
            if (this.value.trim()) {
              diffInputs.forEach(item => item.isValid());
            }
          }
        }
      }
    }
  }
  function inputFocusListener(e) {
    let inputsSameName = Array.from(form.querySelectorAll(`[name="${this.getAttribute('name')}"]`));
    if (opts.disableButton) {
      _this.checkDisableButton();
    }
    if (inputsSameName.length > 1) {
      let isTypesSame = !inputsSameName.find(item => item.getAttribute('type') !== inputsSameName[0].getAttribute('type'));
      let hasRequired = inputsSameName.find(item => typeof item.getAttribute('required') !== 'undefined');
      if (!isTypesSame && hasRequired) {
        if (this.getAttribute('type') !== 'checkbox' && this.getAttribute('type') !== 'radio') {
          let diffInputs = inputsSameName.filter(item => item.getAttribute('type') !== this.getAttribute('type'));
          if (diffInputs.length) {
            diffInputs.forEach(item => item.removeRequired());
            diffInputs.forEach(item => item.checked = false);
            diffInputs.forEach(item => item.isValid());
          }
          this.setRequired();
        }
      }
    }
  }
  function inputFocusoutListener(e) {
    if (opts.disableButton) {
      _this.checkDisableButton();
    }
    let thisInput = this;
    if (!opts.checkOnInput && opts.checkOnFocusOut) {
      thisInput['had_focusout'] = true;
      if (!thisInput['had_focusout'] || !thisInput['had_input'] && !_this.formSubmitted) return;
      clearTimeout(_this.focusoutTimeout);
      _this.focusoutTimeout = setTimeout(function () {
        _this.valid(thisInput);
      }, 300);
    }
  }
  function inputChangeListener(e) {
    if (opts.disableButton) {
      _this.checkDisableButton();
    }
    if (this.getAttribute('type') === 'checkbox' || this.getAttribute('type') === 'radio') {
      this.isValid();
    }
    let inputsSameName = Array.from(form.querySelectorAll(`[name="${this.getAttribute('name')}"]`));
    if (inputsSameName.length > 1) {
      let isTypesSame = !inputsSameName.find(item => item.getAttribute('type') !== inputsSameName[0].getAttribute('type'));
      let hasRequired = inputsSameName.find(item => typeof item.getAttribute('required') !== 'undefined');
      if (!isTypesSame && hasRequired) {
        if (this.getAttribute('type') === 'checkbox' || this.getAttribute('type') === 'radio') {
          let diffInputs = inputsSameName.filter(item => item.getAttribute('type') !== this.getAttribute('type'));
          let thisInputs = inputsSameName.filter(item => item.getAttribute('type') === this.getAttribute('type'));
          let oneChecked = thisInputs.find(item => item.checked);
          if (diffInputs.length) {
            if (oneChecked) {
              diffInputs.forEach(item => item.removeRequired());
              diffInputs.forEach(item => item.isValid());
            } else {
              diffInputs.forEach(item => item.setRequired());
            }
          }
        }
      }
    }
  }
  let _this = {
    isValid: true,
    allInputs: selectAll(opts.dontValidateInputs, form),
    formSubmitted: false,
    init: function () {
      _this.allInputs = selectAll(opts.dontValidateInputs, form);
      form.setAttribute('novalidate', 'novalidate');
      form.setAttribute('data-js-validation', 'novalidate');
      form.addEventListener('submit', formSubmitListener);
      form.valid = function () {
        let addErrors = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
        return _this.validate(false, addErrors);
      };
      _this.allInputs.map(function (input) {
        let thisInputMethods = [];
        let dataValidation = input.getAttribute('data-validation');
        if (input.hasAttribute('required')) {
          thisInputMethods.push({
            callback: opts.methods['required'],
            errorMessage: getMethodError(input, 'required', 'This field is required')
          });
        }
        if (input.hasAttribute('minlength')) {
          thisInputMethods.push({
            callback: opts.methods['minlength'],
            errorMessage: getMethodError(input, 'minlength', 'Min length is &1 symbols', [input.getAttribute('minlength')])
          });
        }
        if (input.hasAttribute('maxlength')) {
          thisInputMethods.push({
            callback: opts.methods['maxlength'],
            errorMessage: getMethodError(input, 'maxlength', 'Max length is &1 symbols', [input.getAttribute('maxlength')])
          });
        }

        // if (input.getAttribute('type') === 'email') {
        //   thisInputMethods.push({
        //     callback: opts.methods['regex'],
        //     passedValue: email_reg,
        //     errorMessage: opts.validationErrors['email']['regex'] || opts.validationErrors['invalid'] || 'This field is invalid'
        //   });
        // }
        if (dataValidation) {
          let thisValidation = opts.validationRules[input.getAttribute('data-validation')];
          if (thisValidation) {
            thisValidation = thisValidation['rules'];
          }
          if (thisValidation) {
            Object.keys(thisValidation).forEach(methodName => {
              let existingMethod = false;
              let thisValidationValue = thisValidation[methodName];
              if (opts.methods[methodName]) {
                existingMethod = {
                  callback: opts.methods[methodName],
                  passedValue: thisValidationValue,
                  errorMessage: getMethodError(input, methodName, opts.validationErrors['invalid'] || 'This field is invalid')
                };
              }
              if (existingMethod) thisInputMethods.push(existingMethod);
            });
          }
        }
        function isInputRequired() {
          let removeIt = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
          let thisInputActualMethods = input['validationMethods'];
          let hasRequired = false;
          thisInputActualMethods.map(function (method) {
            if (method.callback.name === 'required') {
              hasRequired = true;
              if (removeIt) thisInputActualMethods.splice(thisInputActualMethods.indexOf(method), 1);
            }
          });
          return hasRequired;
        }
        function setRequired() {
          let thisInputActualMethods = input['validationMethods'];
          if (isInputRequired()) return;
          thisInputActualMethods.push({
            callback: opts.methods['required'],
            errorMessage: getMethodError(input, 'required', 'This field is required')
          });
          input['validationMethods'] = thisInputMethods;
        }
        function removeRequired() {
          isInputRequired(true);
        }
        function setError(message) {
          _this.highlight(input);
          _this.errorPlacement(message, input);
        }
        function removeError() {
          _this.unhighlight(input);
          _this.errorRemove(input);
        }
        input['setError'] = setError;
        input['removeError'] = removeError;
        input['setRequired'] = setRequired;
        input['removeRequired'] = removeRequired;
        input['isRequired'] = isInputRequired;
        input['validationMethods'] = thisInputMethods;
        input['had_input'] = false;
        input['had_focusout'] = false;
        input['isValid'] = function (addError = true) {
          return _this.valid(input, addError);
        };
        input.addEventListener('input', inputInputListener);
        input.addEventListener('change', inputChangeListener);
        input.addEventListener('focus', inputFocusListener);
        input.addEventListener('focusout', inputFocusoutListener);
      });
      if (opts['rules']) {
        Object.keys(opts['rules']).forEach(function (rule) {
          let input = document.querySelector('[name="' + rule + '"]');
          let thisRuleValue = opts['rules'][rule];
          let thisInputMethods = input['validationMethods'] || [];
          if (!input) return;
          if (thisRuleValue['laravelRequired']) thisRuleValue = 'required';
          let thisRuleMessage = getMethodError(input, thisRuleValue, opts.validationErrors['invalid'] || 'This field is invalid');
          if (opts['messages'] && opts['messages'][rule] && (opts['messages'][rule][thisRuleValue] || opts['messages'][rule]['laravelRequired'])) thisRuleMessage = opts['messages'][rule][thisRuleValue] || opts['messages'][rule]['laravelRequired'];
          if (opts.methods[thisRuleValue]) {
            thisInputMethods.push({
              callback: opts.methods[thisRuleValue],
              errorMessage: thisRuleMessage
            });
            input['validationMethods'] = thisInputMethods;
          }
        });
      }
      if (opts.disableButton) {
        _this.checkDisableButton();
      }
      _this.updateDefaultFormData();
    },
    destroy: function () {
      form.removeAttribute('novalidate', 'novalidate');
      form.removeAttribute('data-js-validation', 'novalidate');
      form.removeEventListener('submit', formSubmitListener);
      form.valid = null;
      _this.allInputs.map(function (input) {
        input['setError'] = null;
        input['removeError'] = null;
        input['setRequired'] = null;
        input['removeRequired'] = null;
        input['isRequired'] = null;
        input['validationMethods'] = null;
        input['had_input'] = false;
        input['had_focusout'] = false;
        input['isValid'] = null;
        input.removeEventListener('input', inputInputListener);
        input.removeEventListener('change', inputChangeListener);
        input.removeEventListener('focus', inputFocusListener);
        input.removeEventListener('focusout', inputFocusoutListener);
      });
    },
    valid: function (input, addError = true) {
      if (input['dont-check']) {
        return true;
      }
      let thisMethods = input['validationMethods'];
      if (!thisMethods) {
        _this.errorRemove(input);
        _this.unhighlight(input);
        return true;
      }
      let isInputValid = true;
      thisMethods.forEach(function (thisMethod) {
        if (!isInputValid) return;
        let isThisValid = thisMethod['callback'](input.value, input, thisMethod['passedValue']);
        if (!isThisValid) {
          if (addError) {
            _this.errorPlacement(thisMethod['errorMessage'], input);
            _this.highlight(input);
            if (opts.trackErrors && typeof window.dataLayer !== 'undefined') {
              window.dataLayer.push({
                event: "form_error",
                form_id: form.id,
                form_name: form.name,
                error_field_label: input.closest(opts.inputContainerSelector) && input.closest(opts.inputContainerSelector).querySelector('label') ? input.closest(opts.inputContainerSelector).querySelector('label') : input.placeholder,
                error_message: thisMethod['errorMessage']
              });
            }
          }
          _this.isValid = isInputValid = false;
        }
      });
      if (isInputValid) {
        _this.errorRemove(input);
        _this.unhighlight(input);
      }
      return isInputValid;
    },
    validate: function () {
      let submit = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;
      let addError = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      let invalidInputs = [];
      _this.isValid = true;
      _this.allInputs.map(function (input) {
        if (!_this.valid(input, addError)) {
          _this.isValid = false;
          invalidInputs.push(input);
        } else {
          input.dataset.validity = '';
        }
      });
      if (_this.isValid) {
        form.classList.remove('has-error');
        if (submit) {
          _this.submitHandler();
        }
      } else {
        let firstInvalidInput = invalidInputs[0];
        form.classList.add('has-error');
        if (!firstInvalidInput.dataset.validity) {
          firstInvalidInput.dataset.validity = "Please fill this field correctly";
          firstInvalidInput.setCustomValidity(firstInvalidInput.dataset.validity);
          firstInvalidInput.reportValidity();
        }
      }
      return _this.isValid;
    },
    highlight: function (element) {
      if (typeof opts.highlightFunction === 'function') {
        opts.highlightFunction(form, element);
        return;
      }
      let container;
      if (typeof opts.inputContainerSelector === 'object') {
        opts.inputContainerSelector.forEach(function (item) {
          if (element.closest(item)) {
            container = element.closest(item);
          }
        });
      } else {
        container = element.closest(opts.inputContainerSelector);
      }
      if (container) container.classList.add(opts.errorClass);
    },
    unhighlight: function (element) {
      if (typeof opts.unhighlightFunction === 'function') {
        opts.unhighlightFunction(form, element);
        return;
      }
      let container;
      if (typeof opts.inputContainerSelector === 'object') {
        opts.inputContainerSelector.forEach(function (item) {
          if (element.closest(item)) {
            container = element.closest(item);
          }
        });
      } else {
        container = element.closest(opts.inputContainerSelector);
      }
      if (container) container.classList.remove(opts.errorClass);
    },
    updateDefaultFormData: function () {
      _this.defaultFormData = new FormData(form);
    },
    checkDisableButton: function () {
      let currentFormData = new FormData(form);
      let formHasChanges = false;
      let formIsValid = form.valid(false);
      if (typeof _this.defaultFormData !== 'undefined') {
        for (let [key, value] of _this.defaultFormData.entries()) {
          if (currentFormData.get(key) !== value) {
            formHasChanges = true;
          }
        }
      }
      if (formIsValid && formHasChanges) {
        form.querySelector('[type="submit"]').removeAttribute('disabled');
      } else {
        form.querySelector('[type="submit"]').setAttribute('disabled', 'disabled');
      }
    },
    errorPlacement: function (error, element) {
      if (!error) return;
      let container;
      if (typeof opts.inputContainerSelector === 'object') {
        opts.inputContainerSelector.forEach(function (item) {
          if (element.closest(item)) {
            container = element.closest(item);
          }
        });
      } else {
        container = element.closest(opts.inputContainerSelector);
      }
      let formErrorBlock = opts.formErrorBlock ? form.querySelector(opts.formErrorBlock) : false;
      if (formErrorBlock) {
        if (!formErrorBlock.querySelector(`[data-name="${element.getAttribute('name')}"]`)) {
          formErrorBlock.innerHTML += `<p data-name="${element.getAttribute('name')}">${error}</p>`;
        }
      }
      if (!container) {
        console.warn('BLACKBOOK Validate: no container for: ', element, opts.inputContainerSelector);
        return;
      }
      if (opts.addInputErrors) {
        let errorEl = container.querySelector('.input__message');
        if (!errorEl) {
          errorEl = document.createElement('div');
          errorEl.classList.add('input__message');
          container.append(errorEl);
        }
        errorEl.innerHTML = `<p>${error}</p>`;
      }
    },
    errorRemove: function (element) {
      let container;
      if (typeof opts.inputContainerSelector === 'object') {
        opts.inputContainerSelector.forEach(function (item) {
          if (element.closest(item)) {
            container = element.closest(item);
          }
        });
      } else {
        container = element.closest(opts.inputContainerSelector);
      }
      let formErrorBlock = opts.formErrorBlock ? form.querySelector(opts.formErrorBlock) : false;
      if (formErrorBlock) {
        if (formErrorBlock.querySelector(`[data-name="${element.getAttribute('name')}"]`)) {
          formErrorBlock.querySelector(`[data-name="${element.getAttribute('name')}"]`).remove();
        }
      }
      if (opts.addInputErrors) {
        if (!container) {
          console.warn('BLACKBOOK Validate: no container for: ', element, opts.inputContainerSelector);
          return;
        }
        container = container.querySelector('.input__message');
        if (!container) return;
        container.innerHTML = '';
      }
    },
    submitHandler: function () {
      if (typeof opts.submitFunction === 'function') {
        opts.submitFunction(form);
      } else {
        form.submit();
      }
    }
  };
  if (form.hasAttribute('data-js-validation')) {
    _this.destroy();
    _this.init();
  } else {
    _this.init();
  }
  form.validateMethods = _this;
  return _this;
}

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./src/lead-form/view.js ***!
  \*******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_helpers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/helpers */ "./src/lead-form/modules/helpers.js");
/* harmony import */ var _modules_form_helpers__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/form_helpers */ "./src/lead-form/modules/form_helpers.js");
/* harmony import */ var _modules_validate__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/validate */ "./src/lead-form/modules/validate.js");
/* harmony import */ var _modules_telInputMask__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./modules/telInputMask */ "./src/lead-form/modules/telInputMask.js");
/* harmony import */ var _modules_inputSelect__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./modules/inputSelect */ "./src/lead-form/modules/inputSelect.js");





function leadFormCallback() {
  let leadForm = document.querySelector('.lead-form:not(.is-initialized)');
  if (!leadForm) {
    return;
  }
  let leadFormConfig = JSON.parse(document.getElementById('form-config-' + leadForm.id).innerHTML);
  let phoneInput = leadForm.querySelector('[data-validation="tel-mask"]');
  leadForm.classList.add('is-initialized');
  function sendAjax() {
    let xhr = new XMLHttpRequest();
    let formData = (0,_modules_form_helpers__WEBPACK_IMPORTED_MODULE_1__.populateUtms)(leadForm, new FormData(leadForm));
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
    formData.append('webhooks', JSON.stringify(leadFormConfig.webhooks));
    xhr.open('post', leadFormConfig.handler);
    xhr.onload = function () {
      if (xhr.status === 200) {
        if (leadFormConfig.redirect) {
          let redirectParams = (0,_modules_form_helpers__WEBPACK_IMPORTED_MODULE_1__.getRedirectParams)(formData, leadFormConfig.query);
          document.location.href = leadFormConfig.redirect + (redirectParams ? '?' + redirectParams : '');
        }
      }
    };
    xhr.send(formData);
  }
  function initAddress() {
    let addressInput = leadForm.querySelector('[data-validation="address-autocomplete"]');
    let addressInputBtn = leadForm.querySelector('[type="submit"]');
    let autocomplete = new google.maps.places.Autocomplete(addressInput, {
      types: ["address"],
      componentRestrictions: {
        country: "us"
      }
    });
    let inputStreet = leadForm.querySelector('[name="street"]');
    let inputCity = leadForm.querySelector('[name="city"]');
    let inputState = leadForm.querySelector('[name="state"]');
    let inputZipcode = leadForm.querySelector('[name="zipcode"]');
    addressInput.autocompleteInstance = autocomplete;
    autocomplete.addListener("place_changed", function () {
      if (addressInput.isValid()) {
        inputStreet.value = addressInput.dataset.street;
        inputCity.value = addressInput.dataset.city;
        inputState.value = addressInput.dataset.state;
        inputZipcode.value = addressInput.dataset.zipcode;
      }
    });
    if (addressInputBtn) {
      addressInputBtn.addEventListener('click', function (e) {
        addressInput.closest('.input').classList.remove('is-error');
      });
    }
  }
  (0,_modules_telInputMask__WEBPACK_IMPORTED_MODULE_3__.telInputMask)(phoneInput, {
    mask: '(xxx) xxx - xxxx',
    hiddenInput: true
  });
  (0,_modules_validate__WEBPACK_IMPORTED_MODULE_2__.validate)(leadForm, {
    submitFunction: sendAjax,
    trackErrors: true
  });
  initAddress();
  (0,_modules_inputSelect__WEBPACK_IMPORTED_MODULE_4__.inputSelect)();
}
document.addEventListener("DOMContentLoaded", function () {
  (0,_modules_helpers__WEBPACK_IMPORTED_MODULE_0__.sessionStorageUTM)();
  loadScript(`https://maps.googleapis.com/maps/api/js?key=${formConfig.googleMapsApiKey}&libraries=places`, leadFormCallback);
});
/******/ })()
;
//# sourceMappingURL=view.js.map