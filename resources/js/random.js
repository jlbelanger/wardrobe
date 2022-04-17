function randomizeCarousel($carousel) {
	const currentI = parseInt($carousel.getAttribute('data-index'), 10);
	const $items = $carousel.querySelectorAll('.carousel__item:not(.hide)');
	const num = $items.length;
	let i;

	do {
		i = Math.floor(Math.random() * num);
	} while (i === currentI);

	scrollToItem($carousel, $items, i, 'auto');
}

function onClickOk(e) {
	const $carousel = e.target.closest('.carousel__container').querySelector('.carousel');
	window.DISABLE_SCROLL = true;
	randomizeCarousel($carousel);
	setTimeout(() => {
		window.DISABLE_SCROLL = false;
	}, 100);
}

const $okButtons = document.querySelectorAll('.carousel-button--ok');
Array.from($okButtons).forEach(($okButton) => {
	$okButton.addEventListener('click', onClickOk);
});

function onClickBrowse() {
	window.DISABLE_SCROLL = true;
	const $carousels = document.querySelectorAll('.carousel__container:not(.hide) .carousel');
	$carousels.forEach(($carousel) => {
		randomizeCarousel($carousel);
	});
	setTimeout(() => {
		window.DISABLE_SCROLL = false;
	}, 100);
}

const $browse = document.getElementById('browse');
$browse.addEventListener('click', onClickBrowse);
