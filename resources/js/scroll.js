function onScrollList(e) {
	if (window.DISABLE_SCROLL) {
		return;
	}

	const $carousel = e.target.closest('.carousel');
	const $items = e.target.querySelectorAll('.carousel__item:not(.hide)');
	const num = $items.length;
	let i;
	let $item;

	for (i = 0; i < num; i += 1) {
		$item = $items[i];
		const rect = $item.getBoundingClientRect();
		if (rect.left >= (rect.width * -1) && rect.right <= (rect.width * 2)) {
			loadImage($item);
			$carousel.setAttribute('data-index', i);
		}
	}
}

const $lists = document.querySelectorAll('.carousel__list');
Array.from($lists).forEach(($list) => {
	$list.addEventListener('scroll', onScrollList);
});
