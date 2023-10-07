export const loadImage = ($item) => {
	const $img = $item.querySelector('.carousel__img');
	const src = $img.getAttribute('data-src');
	if (src) {
		$img.setAttribute('src', src);
		$img.removeAttribute('data-src');
	}
};

export const scrollToItem = ($carousel, $items, i) => {
	const $item = $items[i];
	loadImage($item);

	const $list = $carousel.querySelector('.carousel__list');
	const rect = $item.getBoundingClientRect();
	$list.scrollTo({ left: i * rect.width, behavior: 'smooth' });

	$carousel.setAttribute('data-index', i);
};
