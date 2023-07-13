import { scrollToItem } from './utilities';

function onResize2() {
	const $carousels = document.querySelectorAll('.carousel__container:not(.hide) .carousel');
	Array.from($carousels).forEach(($carousel) => {
		const $items = $carousel.querySelectorAll('.carousel__item:not(.hide)');
		scrollToItem($carousel, $items, parseInt($carousel.getAttribute('data-index'), 10));
	});
	setTimeout(() => {
		window.DISABLE_SCROLL = false;
	}, 500);
}

export default () => {
	window.DISABLE_SCROLL = true;
	if (window.RESIZE_TIMEOUT) {
		clearTimeout(window.RESIZE_TIMEOUT);
	}
	window.RESIZE_TIMEOUT = setTimeout(onResize2, 250);
};
