function isMatch() {
	let colourId = null;
	const $categories = document.querySelectorAll('.carousel__container:not(.hide) .carousel');
	const num = $categories.length;
	let i;
	let $category;
	let $items;
	let $item;

	for (i = 0; i < num; i += 1) {
		$category = $categories[i];
		$items = $category.querySelectorAll('.carousel__item:not(.hide)');
		$item = $items[$category.getAttribute('data-index')];

		if (colourId === null) {
			colourId = $item.getAttribute('data-colour-id');
		} else if ($item.getAttribute('data-colour-id') !== colourId) {
			return false;
		}
	}

	return true;
}

function onClickDressMe() {
	if (isMatch()) {
		document.body.classList.add('flash');
		setTimeout(() => {
			document.body.classList.remove('flash');
		}, 500);
	} else {
		const $mismatch = document.getElementById('mismatch-container');
		$mismatch.classList.remove('hide');
		setTimeout(() => {
			$mismatch.classList.add('hide');
		}, 1000);
	}
}

export default () => {
	const $dressMe = document.getElementById('dress-me');
	$dressMe.addEventListener('click', onClickDressMe);
};
