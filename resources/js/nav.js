function onClickBack(e) {
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
}

function onMousedownBack(e) {
	if (e.button !== 0 || e.altKey || e.ctrlKey || e.metaKey || e.shiftKey) {
		return;
	}
	onClickBack(e);
	window.BACK_INTERVAL = setInterval(() => {
		onClickBack(e);
	}, 400);
}

function onMouseupBack() {
	clearTimeout(window.BACK_INTERVAL);
	window.BACK_INTERVAL = null;
}

function onKeypressBack(e) {
	if (e.key === ' ' || e.key === 'Enter') {
		onClickBack(e);
	}
}

const $backButtons = document.querySelectorAll('.carousel-button--back');
Array.from($backButtons).forEach(($backButton) => {
	$backButton.addEventListener('keypress', onKeypressBack);
	$backButton.addEventListener('mousedown', onMousedownBack);
	$backButton.addEventListener('mouseup', onMouseupBack);
});

function onClickNext(e) {
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
}

function onMousedownNext(e) {
	if (e.button !== 0 || e.altKey || e.ctrlKey || e.metaKey || e.shiftKey) {
		return;
	}
	onClickNext(e);
	window.NEXT_INTERVAL = setInterval(() => {
		onClickNext(e);
	}, 400);
}

function onMouseupNext() {
	clearTimeout(window.NEXT_INTERVAL);
	window.NEXT_INTERVAL = null;
}

function onKeypressNext(e) {
	if (e.key === ' ' || e.key === 'Enter') {
		onClickNext(e);
	}
}

const $nextButtons = document.querySelectorAll('.carousel-button--next');
Array.from($nextButtons).forEach(($nextButton) => {
	$nextButton.addEventListener('keypress', onKeypressNext);
	$nextButton.addEventListener('mousedown', onMousedownNext);
	$nextButton.addEventListener('mouseup', onMouseupNext);
});
