import { loadImage } from './utilities.js';

export const onScrollList = (e) => {
	if (window.DISABLE_SCROLL) {
		return;
	}

	const $carousel = e.target.closest('.carousel');
	const $container = e.target.closest('.carousel__container');
	if ($container.classList.contains('hide')) {
		return;
	}

	const $items = e.target.querySelectorAll('.carousel__item:not(.hide)');
	const num = $items.length;
	let i;
	let $item;
	const offsetLeft = document.getElementById('content-middle').offsetLeft;

	for (i = 0; i < num; i += 1) {
		$item = $items[i];
		const rect = $item.getBoundingClientRect();
		const rectLeft = rect.left - offsetLeft;
		const rectRight = rect.right - offsetLeft;
		const left = (rect.width * -1) - 1; // prettier-ignore
		const right = (rect.width * 2) + 1; // prettier-ignore
		if (rectLeft >= left && rectRight <= right) {
			loadImage($item);
			$carousel.setAttribute('data-index', i);
		}
	}
};

export const initScroll = () => {
	const $lists = document.querySelectorAll('.carousel__list');
	Array.from($lists).forEach(($list) => {
		$list.addEventListener('scroll', onScrollList);
	});
};
