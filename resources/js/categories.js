function onChangeCategory(e) {
	const $checkbox = e.target;
	const categorySlug = $checkbox.getAttribute('value');
	const $carousel = document.getElementById(`category-${categorySlug}`);
	const isVisible = !$carousel.classList.contains('hide');

	if (!isVisible) {
		const $item = $carousel.querySelector('.carousel__item:not(.hide)');
		loadImage($item);
	}

	$carousel.classList.toggle('hide');
}

const $categoryCheckboxes = document.querySelectorAll('.category__checkbox');
Array.from($categoryCheckboxes).forEach(($categoryCheckbox) => {
	$categoryCheckbox.addEventListener('change', onChangeCategory);
});
