function loadImage($item) {
	const $img = $item.querySelector('img');
	const src = $img.getAttribute('data-src');
	if (src) {
		$img.setAttribute('src', src);
		$img.removeAttribute('data-src');
	}
}

function scrollToItem($carousel, $items, i) { // eslint-disable-line no-unused-vars
	const $item = $items[i];
	loadImage($item);
	$item.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
	$carousel.setAttribute('data-index', i);
}
