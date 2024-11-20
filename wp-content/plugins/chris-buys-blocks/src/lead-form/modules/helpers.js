
export function dynamicListener(events, selector, handler, context){
	events.split(' ').forEach(function (event) {
		(document || context).addEventListener(event, function (e) {
			if(e.target.matches(selector) || e.target.closest(selector)){
				handler.call(e.target.closest(selector), e);
			}
		})
	})
}
export function trigger(el, eventName, params = {}) {
	let thisEl = el
	let thisEventName = eventName
	let thisParams = params

	if(typeof el === 'string'){
		thisEventName = el
		thisEl = document
		if(typeof eventName === 'object'){
			thisParams = eventName
		}
	}

	let newEvent = new CustomEvent(thisEventName, { bubbles: true, detail: thisParams });
	thisEl.dispatchEvent(newEvent)
}

function animateHeight(element, duration, startHeight, targetHeight, onComplete) {
	let elStyles = window.getComputedStyle(element)
	let paddingTop = elStyles.paddingTop.replace('px', '')
	let paddingBottom = elStyles.paddingBottom.replace('px', '')
	if (!startHeight) {
		startHeight = element.clientHeight
	}
	let currentHeight = startHeight;


	element.style.transition = '';

	if (targetHeight) {
		if (paddingTop) {
			startHeight -= paddingTop
			element.style.paddingTop = '0'
			setTimeout(function () {
				element.style.transition = `padding ${duration}ms linear`
				element.style.paddingTop = paddingTop + 'px'
			}, 10)
		}
		if (paddingBottom) {
			startHeight -= paddingBottom
			element.style.paddingBottom = '0px'
			setTimeout(function () {
				element.style.transition = `padding ${duration}ms linear`
				element.style.paddingBottom = paddingBottom + 'px'
			}, 10)
		}
		currentHeight = startHeight
	} else {
		if (paddingTop) {
			element.style.transition = `padding ${duration}ms linear`
			element.style.paddingTop = '0px'
		}
		if (paddingBottom) {
			element.style.transition = `padding ${duration}ms linear`
			element.style.paddingBottom = '0px'
		}
	}
	if ((startHeight / targetHeight) !== Infinity) {
		duration = duration - (duration * (startHeight / targetHeight))
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
				element.style.display = 'none'
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
		stop: stopAnimation,
	};
	updateHeight();
}
export function slideDown(element, duration, display = 'block', onComplete) {
	let startHeight = element.clientHeight;
	element.style.display = display;
	element.style.height = 'unset'
	const targetHeight = element.clientHeight;
	element.style.height = '0px';
	element.style.overflow = 'hidden';

	animateHeight(element, duration, startHeight, targetHeight, onComplete);
}
export function slideUp(element, duration, onComplete) {
	const targetHeight = 0;
	element.style.overflow = 'hidden';

	animateHeight(element, duration, false, targetHeight, onComplete);
}

function animateOpacity(element, duration, display = 'block', targetOpacity, onComplete) {
	const elStyles = window.getComputedStyle(element)
	const startOpacity = elStyles.display === 'none' ? 0 : parseFloat(elStyles.opacity)
	let currentOpacity = startOpacity;

	if(startOpacity !== 1) {
		duration = duration - (duration * startOpacity);
	}

	if (targetOpacity) {
		element.style.opacity = startOpacity
		element.style.display = display
	}

	if (element.animation && element.animation.stop) {
		element.animation.stop()
	}

	function updateOpacity() {
		const elapsedTime = performance.now() - startTime;
		const progress = Math.min(1, elapsedTime / duration);
		currentOpacity = startOpacity + progress * (targetOpacity - startOpacity);
		element.style.opacity = currentOpacity.toFixed(2);

		if (progress < 1) {
			element.animation.raf = requestAnimationFrame(updateOpacity);
		} else {
			element.style.opacity = ''
			element.animation = false
			if (!targetOpacity) {
				element.style.display = 'none'
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
		stop: stopAnimation,
	};
	updateOpacity();
}
export function fadeIn(el, timeout, display = 'block', afterFunc = false) {
	animateOpacity(el, timeout, display, 1, afterFunc);
}
export function fadeOut(el, timeout, afterFunc = false) {
	animateOpacity(el, timeout, '', 0, afterFunc);
}
