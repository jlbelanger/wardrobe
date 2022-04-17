function loadImage($item) {
	const src = $item.getAttribute('data-src');
	if (src) {
		$item.style.backgroundImage = `url('${src}')`;
		$item.removeAttribute('data-src');
	}
}

function scrollToItem($carousel, $items, i, behavior = 'smooth') { // eslint-disable-line no-unused-vars
	const $item = $items[i];
	loadImage($item);
	$item.scrollIntoView({ block: 'nearest', behavior });
	$carousel.setAttribute('data-index', i);
}
