function onResize() {
	window.DISABLE_SCROLL = true;
	if (window.RESIZE_TIMEOUT) {
		clearTimeout(window.RESIZE_TIMEOUT);
	}
	window.RESIZE_TIMEOUT = setTimeout(onResize2, 250);
}

function onResize2() {
	const $carousels = document.querySelectorAll('.carousel');
	Array.from($carousels).forEach(($carousel) => {
		const $items = $carousel.querySelectorAll('.carousel__item:not(.hide)');
		scrollToItem($carousel, $items, parseInt($carousel.getAttribute('data-index'), 10));
	});
	setTimeout(() => {
		window.DISABLE_SCROLL = false;
	}, 500);
}

window.addEventListener('resize', onResize);
