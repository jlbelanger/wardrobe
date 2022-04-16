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

function onClickOk(e) {
	const $carousel = e.target.closest('.carousel__container').querySelector('.carousel');
	randomizeCarousel($carousel);
}

const $okButtons = document.querySelectorAll('.carousel-button--ok');
Array.from($okButtons).forEach(($okButton) => {
	$okButton.addEventListener('click', onClickOk);
});

function onClickBrowse() {
	const $carousels = document.querySelectorAll('.carousel__container:not(.hide) .carousel');
	$carousels.forEach(($carousel) => {
		randomizeCarousel($carousel);
	});
}

const $browse = document.getElementById('browse');
$browse.addEventListener('click', onClickBrowse);
