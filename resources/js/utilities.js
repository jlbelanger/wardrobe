function loadImage($item) {
	const src = $item.getAttribute('data-src');
	if (src) {
		$item.style.backgroundImage = `url('${src}')`;
		$item.removeAttribute('data-src');
	}
}

function scrollToItem($carousel, $items, i) { // eslint-disable-line no-unused-vars
	const $item = $items[i];
	loadImage($item);

	const $list = $carousel.querySelector('.carousel__list');
	const rect = $item.getBoundingClientRect();
	$list.scrollTo({ left: i * rect.width, behavior: 'smooth' });

	$carousel.setAttribute('data-index', i);
}
