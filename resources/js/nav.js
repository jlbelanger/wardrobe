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

const $backButtons = document.querySelectorAll('.carousel-button--back');
Array.from($backButtons).forEach(($backButton) => {
	$backButton.addEventListener('click', onClickBack);
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

const $nextButtons = document.querySelectorAll('.carousel-button--next');
Array.from($nextButtons).forEach(($nextButton) => {
	$nextButton.addEventListener('click', onClickNext);
});
