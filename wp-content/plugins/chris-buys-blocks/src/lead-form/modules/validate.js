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
	},
};
const validationMethods = {
	"addressAutocomplete": function (_, autocompleteField) {
		if(!autocompleteField.autocompleteInstance){
			return true;
		}
		if(!autocompleteField.value.trim()){
			if(autocompleteField.closest('.is-error')){
				return;
			}
			autocompleteField.dataset.validity = "Please re-enter and select your address from the dropdown"
			autocompleteField.setCustomValidity(autocompleteField.dataset.validity);
			autocompleteField.reportValidity();
			return false;
		}
		const place = autocompleteField.autocompleteInstance.getPlace();
		if (!place || !place.geometry) {
			if(autocompleteField.closest('.is-error')){
				return;
			}
			autocompleteField.dataset.validity = "Address must include a street number"
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
			if(autocompleteField.closest('.is-error')){
				return;
			}
			autocompleteField.dataset.validity = "Address must include a street number"
			autocompleteField.setCustomValidity(autocompleteField.dataset.validity);
			autocompleteField.reportValidity();
			return false;
		}

		autocompleteField.dataset.validity = ''
		autocompleteField.setCustomValidity('');

		autocompleteField.dataset.error = ''

		autocompleteField.dataset.street = streetAddress;
		autocompleteField.dataset.city = city;
		autocompleteField.dataset.state = stateLong;
		autocompleteField.dataset.zipcode = zipcode;

		autocompleteField.value = `${streetAddress}, ${city}, ${stateShort}, ${zipcode}`;

		return true;
	},
	"telMask": function (_, input) {
		return !input.required || input.isFilled();
	},
}

export function validate(form, newOpts = {}) {
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
				if(input.getAttribute('type') === 'checkbox' || input.getAttribute('type') === 'radio'){
					let elseInputs = Array.from(form.querySelectorAll(`[name="${input.getAttribute('name')}"]`))
					let hasChecked = !!elseInputs.find(item => item.checked)

					if(hasChecked){
						elseInputs.forEach(function (elseInput) {
							if(typeof elseInput.removeError === 'function') {
								elseInput.removeError()
							}
						})
					}

					return hasChecked
				} else {
					return !!value.trim()
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
	if(typeof validationMethods === 'object') {
		opts["methods"] = {
			...opts["methods"],
			...validationMethods
		}
	}
	if (typeof form === 'string') form = document.querySelector(form);

	function selectAll(selector, container = false) {
		return Array.from(!container ? document.querySelectorAll(selector) : container.querySelectorAll(selector));
	}
	function printf(string, vars = [], addToEnd = true, char = '&') {
		vars.forEach(function (thisVar, index) {
			let r = new RegExp(char + (index + 1) + '(?![0-9])', 'g');

			if(r.test(string)) {
				string = string.replace(r, thisVar);
			} else if(addToEnd) {
				string += ' '+thisVar
			}
		})
		return string;
	}

	function getMethodError(input, methodName, defaultText, variable = []) {
		let dataValidation = input.getAttribute('data-validation');
		let errorMessage = printf(defaultText, variable)

		if(opts.validationErrors[methodName]){
			errorMessage = printf(opts.validationErrors[methodName], variable)
		}
		if(opts.validationErrors[dataValidation] && opts.validationErrors[dataValidation][methodName]){
			errorMessage = printf(opts.validationErrors[dataValidation][methodName], variable)
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
		this.dataset.validity = ''
		this.setCustomValidity("");
		if(!opts.checkOnInput && !opts.checkOnInputAfterSubmit){
			return;
		}
		if(opts.disableButton){
			_this.checkDisableButton()
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

		let inputsSameName = Array.from(form.querySelectorAll(`[name="${this.getAttribute('name')}"]`))

		if(inputsSameName.length > 1){
			let isTypesSame = !inputsSameName.find(item => item.getAttribute('type') !== inputsSameName[0].getAttribute('type'))
			let hasRequired = inputsSameName.find(item => typeof item.getAttribute('required') !== 'undefined')

			if(!isTypesSame && hasRequired) {
				if(this.getAttribute('type') !== 'checkbox' && this.getAttribute('type') !== 'radio'){
					let diffInputs = inputsSameName.filter(item => item.getAttribute('type') !== this.getAttribute('type'))

					if(diffInputs.length){
						if(this.value.trim()){
							diffInputs.forEach(item => item.isValid())
						}
					}
				}
			}
		}
	}
	function inputFocusListener(e) {
		let inputsSameName = Array.from(form.querySelectorAll(`[name="${this.getAttribute('name')}"]`))
		if(opts.disableButton){
			_this.checkDisableButton()
		}
		if(inputsSameName.length > 1){
			let isTypesSame = !inputsSameName.find(item => item.getAttribute('type') !== inputsSameName[0].getAttribute('type'))
			let hasRequired = inputsSameName.find(item => typeof item.getAttribute('required') !== 'undefined')

			if(!isTypesSame && hasRequired) {
				if(this.getAttribute('type') !== 'checkbox' && this.getAttribute('type') !== 'radio'){
					let diffInputs = inputsSameName.filter(item => item.getAttribute('type') !== this.getAttribute('type'))

					if(diffInputs.length){
						diffInputs.forEach(item => item.removeRequired())
						diffInputs.forEach(item => item.checked = false)
						diffInputs.forEach(item => item.isValid())
					}
					this.setRequired()
				}
			}
		}
	}
	function inputFocusoutListener(e) {
		if(opts.disableButton){
			_this.checkDisableButton()
		}
		let thisInput = this
		if (!opts.checkOnInput && opts.checkOnFocusOut) {
			thisInput['had_focusout'] = true;
			if (!thisInput['had_focusout'] || (!thisInput['had_input'] && !_this.formSubmitted)) return;
			clearTimeout(_this.focusoutTimeout)
			_this.focusoutTimeout = setTimeout(function () {
				_this.valid(thisInput);
			}, 300)
		}
	}
	function inputChangeListener(e) {
		if(opts.disableButton){
			_this.checkDisableButton()
		}
		if (this.getAttribute('type') === 'checkbox' || this.getAttribute('type') === 'radio' ) {
			this.isValid()
		}


		let inputsSameName = Array.from(form.querySelectorAll(`[name="${this.getAttribute('name')}"]`))

		if(inputsSameName.length > 1){
			let isTypesSame = !inputsSameName.find(item => item.getAttribute('type') !== inputsSameName[0].getAttribute('type'))
			let hasRequired = inputsSameName.find(item => typeof item.getAttribute('required') !== 'undefined')

			if(!isTypesSame && hasRequired) {
				if(this.getAttribute('type') === 'checkbox' || this.getAttribute('type') === 'radio'){
					let diffInputs = inputsSameName.filter(item => item.getAttribute('type') !== this.getAttribute('type'))
					let thisInputs = inputsSameName.filter(item => item.getAttribute('type') === this.getAttribute('type'))
					let oneChecked = thisInputs.find(item => item.checked)

					if(diffInputs.length){
						if(oneChecked){
							diffInputs.forEach(item => item.removeRequired())
							diffInputs.forEach(item => item.isValid())
						} else {
							diffInputs.forEach(item => item.setRequired())
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
			_this.allInputs = selectAll(opts.dontValidateInputs, form)
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
							if (opts.methods[methodName]){
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
					_this.highlight(input)
					_this.errorPlacement(message, input)
				}
				function removeError() {
					_this.unhighlight(input)
					_this.errorRemove(input)
				}
				input['setError'] = setError
				input['removeError'] = removeError
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
					let thisRuleMessage = getMethodError(input, thisRuleValue, opts.validationErrors['invalid'] || 'This field is invalid')
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

			if(opts.disableButton){
				_this.checkDisableButton()
			}

			_this.updateDefaultFormData()
		},
		destroy: function () {
			form.removeAttribute('novalidate', 'novalidate');
			form.removeAttribute('data-js-validation', 'novalidate');
			form.removeEventListener('submit', formSubmitListener);
			form.valid = null;
			_this.allInputs.map(function (input) {
				input['setError'] = null
				input['removeError'] = null
				input['setRequired'] = null;
				input['removeRequired'] = null;
				input['isRequired'] = null;
				input['validationMethods'] = null;
				input['had_input'] = false;
				input['had_focusout'] = false;
				input['isValid'] = null
				input.removeEventListener('input', inputInputListener);
				input.removeEventListener('change', inputChangeListener);
				input.removeEventListener('focus', inputFocusListener);
				input.removeEventListener('focusout', inputFocusoutListener);
			});
		},
		valid: function (input, addError = true) {
			if(input['dont-check']){
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
						if(opts.trackErrors && typeof window.dataLayer !== 'undefined'){
							window.dataLayer.push({
								event: "form_error",
								form_id: form.id,
								form_name: form.name,
								error_field_label: input.closest(opts.inputContainerSelector) && input.closest(opts.inputContainerSelector).querySelector('label') ? input.closest(opts.inputContainerSelector).querySelector('label') : input.placeholder,
								error_message: thisMethod['errorMessage'],
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
			let invalidInputs = []
			_this.isValid = true;
			_this.allInputs.map(function (input) {
				if (!_this.valid(input, addError)) {
					_this.isValid = false;
					invalidInputs.push(input)
				} else {
					input.dataset.validity = ''
				}
			});
			if (_this.isValid){
				form.classList.remove('has-error')
				if(submit) {
					_this.submitHandler();
				}
			} else {
				let firstInvalidInput = invalidInputs[0]

				form.classList.add('has-error')

				if(!firstInvalidInput.dataset.validity) {
					firstInvalidInput.dataset.validity = "Please fill this field correctly"
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
			if(typeof opts.inputContainerSelector === 'object'){
				opts.inputContainerSelector.forEach(function (item) {
					if(element.closest(item)) {
						container = element.closest(item)
					}
				})
			} else {
				container = element.closest(opts.inputContainerSelector)
			}
			if (container) container.classList.add(opts.errorClass);
		},
		unhighlight: function (element) {
			if (typeof opts.unhighlightFunction === 'function') {
				opts.unhighlightFunction(form, element);
				return;
			}
			let container;
			if(typeof opts.inputContainerSelector === 'object'){
				opts.inputContainerSelector.forEach(function (item) {
					if(element.closest(item)) {
						container = element.closest(item)
					}
				})
			} else {
				container = element.closest(opts.inputContainerSelector)
			}
			if (container) container.classList.remove(opts.errorClass);
		},
		updateDefaultFormData: function () {
			_this.defaultFormData = new FormData(form)
		},
		checkDisableButton: function () {
			let currentFormData = new FormData(form)
			let formHasChanges = false
			let formIsValid = form.valid(false)

			if(typeof _this.defaultFormData !== 'undefined') {
				for (let [key, value] of _this.defaultFormData.entries()) {
					if (currentFormData.get(key) !== value) {
						formHasChanges = true
					}
				}
			}

			if(formIsValid && formHasChanges){
				form.querySelector('[type="submit"]').removeAttribute('disabled')
			} else {
				form.querySelector('[type="submit"]').setAttribute('disabled', 'disabled')
			}
		},
		errorPlacement: function (error, element) {
			if (!error) return;
			let container;
			if(typeof opts.inputContainerSelector === 'object'){
				opts.inputContainerSelector.forEach(function (item) {
					if(element.closest(item)) {
						container = element.closest(item)
					}
				})
			} else {
				container = element.closest(opts.inputContainerSelector)
			}
			let formErrorBlock = opts.formErrorBlock ? form.querySelector(opts.formErrorBlock) : false
			if(formErrorBlock){
				if(!formErrorBlock.querySelector(`[data-name="${element.getAttribute('name')}"]`)) {
					formErrorBlock.innerHTML += `<p data-name="${element.getAttribute('name')}">${error}</p>`;
				}
			}
			if (!container){ console.warn('BLACKBOOK Validate: no container for: ', element, opts.inputContainerSelector); return; }

			if(opts.addInputErrors) {
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
			if(typeof opts.inputContainerSelector === 'object'){
				opts.inputContainerSelector.forEach(function (item) {
					if(element.closest(item)) {
						container = element.closest(item)
					}
				})
			} else {
				container = element.closest(opts.inputContainerSelector)
			}
			let formErrorBlock = opts.formErrorBlock ? form.querySelector(opts.formErrorBlock) : false
			if(formErrorBlock){
				if(formErrorBlock.querySelector(`[data-name="${element.getAttribute('name')}"]`)) {
					formErrorBlock.querySelector(`[data-name="${element.getAttribute('name')}"]`).remove()
				}
			}
			if(opts.addInputErrors) {
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

	if (form.hasAttribute('data-js-validation')){
		_this.destroy();
		_this.init();
	} else {
		_this.init();
	}
	form.validateMethods = _this;
	return _this;
}