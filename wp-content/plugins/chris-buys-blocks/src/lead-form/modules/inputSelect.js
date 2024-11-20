import { fadeIn, fadeOut, slideUp, slideDown, dynamicListener, trigger } from "./helpers";

export function dropdown(options) {
	let opts = {
		globalContainer: '',
		containerClass: 'header__lang',
		btnSelector: '.header__lang-btn',
		closeBtnClass: '',
		dropdownSelector: '.header__lang-dropdown',
		timing: 300,
		effect: 'slide',
		closeOnClick: true,
		closeOnClickOutside: true,
	};
	let timing = 300;
	opts = { ...opts, ...options }

	let openTimeout = false;

	function open(e) {
		e.preventDefault();
		let container = e.target.closest('.' + opts.containerClass);
		let thisDropdown = container.querySelector(opts.dropdownSelector);
		if(openTimeout){
			return;
		}
		setTimeout(function () {
			openTimeout = false
		}, 200)
		openTimeout = true
		if(container.classList.contains('is-open')){
			close()
			return;
		}
		if (e.type === 'focusin') {
			container.classList.add('focusin');
		}
		if (e.type !== 'focusin') {
			container.classList.remove('focusin');
		}
		close(container);

		container.classList.add('is-open')
		container.style.zIndex = '4';

		if (opts.effect === 'fade') {
			fadeIn(thisDropdown, timing)
		} else if(opts.effect === 'slide') {
			slideDown(thisDropdown, timing)
		} else {
			console.error('Dropdown plugin: There is no effect called "' + opts.effect + '". Effects: "slide", "fade".')
		}
	}
	function close(dontClose) {
		let dropdownsToClose = document.querySelectorAll('.' + opts.containerClass);

		if (dontClose) {
			dropdownsToClose = Array.from(dropdownsToClose).filter(item => item !== dontClose);
		}

		if(!dropdownsToClose.length) {
			return;
		}

		dropdownsToClose.forEach(function (dropdownToClose) {
			if(!dropdownToClose.classList.contains('is-open')){
				return;
			}
			dropdownToClose.classList.remove('is-open')
			dropdownToClose.querySelectorAll('li').forEach(item => item.classList.remove('hover'))
			dropdownToClose.style.zIndex = ''
			if (opts.effect === 'fade') {
				fadeOut(dropdownToClose.querySelector(opts.dropdownSelector), timing)
			} else if(opts.effect === 'slide') {
				slideUp(dropdownToClose.querySelector(opts.dropdownSelector), timing)
			} else {
				console.error('Dropdown plugin: There is no effect called "' + opts.effect + '". Effects: "slide", "fade".')
			}
		})
	}


	if(opts.closeOnClickOutside) {
		document.addEventListener('click', function (e) {
			let thisEl = e.target;
			if (opts.closeBtnClass ? thisEl.classList.contains(opts.closeBtnClass) : false) {
				close();
			}
			if (!thisEl.classList.contains(opts.containerClass) && !thisEl.closest('.' + opts.containerClass)) {
				close();
			}
		})
	}
	dynamicListener('click', opts.globalContainer + ' .' + opts.containerClass + ' ' + opts.btnSelector, open)
	dynamicListener('focusin', opts.globalContainer + ' .' + opts.containerClass + ' ' + opts.btnSelector, open);
	dynamicListener('focusout', opts.globalContainer + ' .' + opts.containerClass + ' ' + opts.btnSelector, function (e) {
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
		dynamicListener('click', opts.globalContainer + ' .' + opts.containerClass + ' ' + opts.dropdownSelector, function (e) {
			if (!e.target.closest('.' + opts.containerClass).classList.contains('checkbox')) {
				close();
			}
		});
	}
}
export function inputSelect() {
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

		if(outText) {
			outText.value = text || outText.placeholder;
		}
		if(outValue) {
			outValue.value = value;
			if(typeof outValue.isValid === 'function'){
				outValue.isValid();
			}
		}
		option.classList.add('is-selected');

		Array.from(option.parentElement.children).forEach(function (item) {
			if(item != option){
				item.classList.remove('is-selected')
			}
		})

		if(!container.classList.contains('has-checkbox') ) {
			trigger('close-dropdown')
		}
	}

	dynamicListener('click', '.input--select li', selectItem)

	document.querySelectorAll('.input--select [data-value].is-selected').forEach(function (item) {
		selectItem({target: item})
	})
}