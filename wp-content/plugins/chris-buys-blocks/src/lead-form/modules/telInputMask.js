export function telInputMask(input, newOpts={}) {
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
		onFilled: (unmaskedValue, maskedValue)=>{}
	};
	let opts = {
		...defaultOpts,
		...newOpts
	};
	if(!opts.mask){
		return;
	}
	let maskArray = opts.mask.split('')
	let firstFillableChar = 0

	maskArray.find((item, index)=>{
		let isFillable = isMaskCharFillable(item).isFillable
		if(isFillable){
			firstFillableChar = index
		}
		return isFillable
	})
	if(opts.hiddenInput){
		let hiddenInput = document.createElement('input')

		hiddenInput.type = 'hidden'
		hiddenInput.name = input.name
		input.name = input.name+'_masked'
		input.hiddenInput = hiddenInput
		input.insertAdjacentElement('afterend', hiddenInput)

		hiddenInput.value = getUnmaskedValue(input.value)
		if(opts.hiddenInput.mask) {
			onInput.call(hiddenInput, opts.hiddenInput.mask)
		}
	}

	function getUnmaskedValue(maskedString, mask=opts.mask) {
		let result = '';
		let maskIndex = 0;
		let maskedIndex = 0;

		maskedString = maskedString.replaceAll(opts.placeholders.number, '').replaceAll(opts.placeholders.letter, '').replaceAll(' ', '')

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
		let returnArray = {}

		returnArray.number = /\d/.test(char)
		returnArray.letter = /[A-Za-zА-Яа-яІіЇїЄєҐґ]/.test(char)
		returnArray.isFillable = returnArray.number || returnArray.letter

		return returnArray
	}
	function isMaskCharFillable(char) {
		let returnArray = {}

		returnArray.number = char === opts.chars.number
		returnArray.letter = char === opts.chars.letter
		returnArray.isFillable = returnArray.number || returnArray.letter

		return returnArray
	}
	function onInput(mask=opts.mask) {
		let thisValue = this.type !== 'hidden' ? getUnmaskedValue(this.value, mask).split('') : this.value.split('')
		let finalValue = ''
		let count = 0
		let thisMaskArray = this.type !== 'hidden' ? maskArray : mask.split('')

		thisValue.forEach(function (valueChar, index) {
			let fillableChar = isCharFillable(valueChar)
			if(!fillableChar.isFillable){
				return;
			}
			let fillableMaskChar;
			while (count < thisMaskArray.length){
				fillableMaskChar = isMaskCharFillable(thisMaskArray[count])
				if(fillableMaskChar.isFillable){
					break;
				}
				finalValue += thisMaskArray[count]
				count++;
			}
			if((fillableMaskChar.number && fillableChar.number) || (fillableMaskChar.letter && fillableChar.letter)){
				finalValue += valueChar
			}
			count++
		})

		let finalValueLength = finalValue.length

		for (let i = (finalValue === '' ? 0 : finalValue.length); i < mask.length; i++){
			if(mask[i] === opts.chars.number){
				finalValue += opts.placeholders ? opts.placeholders.number : ''
			} else if(mask[i] === opts.chars.letter){
				finalValue += opts.placeholders ? opts.placeholders.letter : ''
			} else {
				finalValue += mask[i]
			}
		}

		this.value = finalValue

		if(this.type !== 'hidden') {
			if (finalValueLength) {
				this.setSelectionRange(finalValueLength, finalValueLength);
			} else {
				this.setSelectionRange(firstFillableChar, firstFillableChar);
			}
			if(this.hiddenInput) {
				this.hiddenInput.value = getUnmaskedValue(this.value)

				if (opts.hiddenInput.mask) {
					onInput.call(this.hiddenInput, opts.hiddenInput.mask)
				}
			}
		}
		if(this.value.replaceAll(opts.placeholders.number, '').replaceAll(opts.placeholders.letter, '').length === mask.length){
			let unmaskedValue = getUnmaskedValue(this.value)
			opts.onFilled(unmaskedValue, this.value)
		}
	}

	input.getUnmaskedValue = ()=>{
		return getUnmaskedValue(input.value)
	}
	input.isFilled = ()=>{
		return input.value.replaceAll(opts.placeholders.number, '').replaceAll(opts.placeholders.letter, '').length === opts.mask.length
	}
	input.addEventListener('input', function () {
		onInput.call(this)
	})
	if(opts.showOnFocus) {
		input.addEventListener('focus', function () {
			onInput.call(this)
		})
	}
	if(opts.clearOnBlur) {
		input.addEventListener('blur', function () {
			if(!getUnmaskedValue(this.value)){
				this.value = ''
			}
		})
	}
}