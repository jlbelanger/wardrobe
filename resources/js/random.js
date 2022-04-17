function randomizeCarousel($carousel) {
	const currentI = parseInt($carousel.getAttribute('data-index'), 10);
	const $items = $carousel.querySelectorAll('.carousel__item:not(.hide)');
	const num = $items.length;
	let i;

	do {
		i = Math.floor(Math.random() * num);
	} while (i === currentI);

	scrollToItem($carousel, $items, i);
}

function onClickRandomize(e) {
	const $carousel = e.target.closest('.carousel__container').querySelector('.carousel');
	window.DISABLE_SCROLL = true;
	randomizeCarousel($carousel);
	setTimeout(() => {
		window.DISABLE_SCROLL = false;
	}, 500);
}

const $randomizeButtons = document.querySelectorAll('.carousel-button--randomize');
Array.from($randomizeButtons).forEach(($randomizeButton) => {
	$randomizeButton.addEventListener('click', onClickRandomize);
});

function onClickBrowse() {
	window.DISABLE_SCROLL = true;
	const $carousels = document.querySelectorAll('.carousel__container:not(.hide) .carousel');
	$carousels.forEach(($carousel) => {
		randomizeCarousel($carousel);
	});
	setTimeout(() => {
		window.DISABLE_SCROLL = false;
	}, 500);
}

const $browse = document.getElementById('browse');
$browse.addEventListener('click', onClickBrowse);
