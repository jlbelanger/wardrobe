import { scrollToItem } from './utilities.js';

function onClickBack(e, enableScroll = true) {
	window.DISABLE_SCROLL = true;

	const $carousel = e.target.closest('.carousel__container').querySelector('.carousel');
	const currentI = parseInt($carousel.getAttribute('data-index'), 10);
	const $items = $carousel.querySelectorAll('.carousel__item:not(.hide)');
	const num = $items.length;
	let i;

	if (currentI > 0) {
		i = currentI - 1;
	} else {
		i = num - 1;
	}

	scrollToItem($carousel, $items, i);

	if (enableScroll) {
		setTimeout(() => {
			window.DISABLE_SCROLL = false;
		}, 500);
	}
}

function onMousedownBack(e) {
	clearInterval(window.BACK_INTERVAL);
	clearInterval(window.NEXT_INTERVAL);
	if (e.button !== 0 || e.altKey || e.ctrlKey || e.metaKey || e.shiftKey) {
		return;
	}
	onClickBack(e, false);
	window.BACK_INTERVAL = setInterval(() => {
		onClickBack(e, false);
	}, 400);
}

function onMouseupBack() {
	clearInterval(window.BACK_INTERVAL);
	window.BACK_INTERVAL = null;

	setTimeout(() => {
		window.DISABLE_SCROLL = false;
	}, 500);
}

function onKeypressBack(e) {
	if (e.key === ' ' || e.key === 'Enter') {
		onClickBack(e);
	}
}

function onClickNext(e, enableScroll = true) {
	window.DISABLE_SCROLL = true;

	const $carousel = e.target.closest('.carousel__container').querySelector('.carousel');
	const currentI = parseInt($carousel.getAttribute('data-index'), 10);
	const $items = $carousel.querySelectorAll('.carousel__item:not(.hide)');
	const num = $items.length;
	let i;

	if (currentI < (num - 1)) {
		i = currentI + 1;
	} else {
		i = 0;
	}

	scrollToItem($carousel, $items, i);

	if (enableScroll) {
		setTimeout(() => {
			window.DISABLE_SCROLL = false;
		}, 500);
	}
}

function onMousedownNext(e) {
	clearInterval(window.BACK_INTERVAL);
	clearInterval(window.NEXT_INTERVAL);
	if (e.button !== 0 || e.altKey || e.ctrlKey || e.metaKey || e.shiftKey) {
		return;
	}
	onClickNext(e, false);
	window.NEXT_INTERVAL = setInterval(() => {
		onClickNext(e, false);
	}, 400);
}

function onMouseupNext() {
	clearInterval(window.NEXT_INTERVAL);
	window.NEXT_INTERVAL = null;

	setTimeout(() => {
		window.DISABLE_SCROLL = false;
	}, 500);
}

function onKeypressNext(e) {
	if (e.key === ' ' || e.key === 'Enter') {
		onClickNext(e);
	}
}

export default () => {
	const $backButtons = document.querySelectorAll('.carousel-button--back');
	Array.from($backButtons).forEach(($backButton) => {
		$backButton.addEventListener('keypress', onKeypressBack);
		$backButton.addEventListener('mousedown', onMousedownBack);
		$backButton.addEventListener('mouseup', onMouseupBack);
	});

	const $nextButtons = document.querySelectorAll('.carousel-button--next');
	Array.from($nextButtons).forEach(($nextButton) => {
		$nextButton.addEventListener('keypress', onKeypressNext);
		$nextButton.addEventListener('mousedown', onMousedownNext);
		$nextButton.addEventListener('mouseup', onMouseupNext);
	});
};
