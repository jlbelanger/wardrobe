export const loadImage = ($item) => {
	const src = $item.getAttribute('data-src');
	if (src) {
		$item.style.backgroundImage = `url('${src}')`;
		$item.removeAttribute('data-src');
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
