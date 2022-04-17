function getAnimationDelay(i) {
	return (150 * i) + 100;
}

function setAnimation(i, elem) {
	var delay = getAnimationDelay(i);
	elem.style.animationDelay = delay + 'ms';
	elem.style.animationName = 'appear';
}

function animate() {
	document.getElementById('hangers').remove();

	const $carousels = document.querySelectorAll('.carousel__container');
	const num = $carousels.length;
	let i;
	let j = 0;

	for (i = 0; i < num; i++) {
		if (!$carousels[i].classList.contains('hide')) {
			setAnimation(j, $carousels[i]);
			j += 1;
		}
	}

	const $browse = document.getElementById('browse');
	setAnimation(j, $browse);

	const $dressMe = document.getElementById('dress-me');
	setAnimation(j, $dressMe);

	const delay = getAnimationDelay(j + 1);
	setTimeout(() => {
		$carousels.forEach(($carousel) => {
			$carousel.classList.remove('invisible');
		});
		$browse.classList.remove('invisible');
		$dressMe.classList.remove('invisible');
	}, delay);
}

function onLoad() {
	const $seasons = document.getElementById('seasons');
	if ($seasons.value !== $seasons.getAttribute('data-default')) {
		onChangeSeason({ target: $seasons });
	}

	const $categories = document.querySelectorAll('.category__checkbox');
	Array.from($categories).forEach(($category) => {
		const isDefault = $category.getAttribute('data-default');
		if (($category.checked && !isDefault) || (!$category.checked && isDefault)) {
			onChangeCategory({ target: $category });
		}
	});

	setTimeout(animate, 1000);
}

window.addEventListener('load', onLoad);
