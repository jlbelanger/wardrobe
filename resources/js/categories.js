function onClickCategory(e) {
	const $categoryButton = e.target;
	const isVisible = $categoryButton.classList.contains('footer__link--active');

	$categoryButton.classList.toggle('footer__link--active');

	const categoryId = $categoryButton.getAttribute('data-category-id');
	const $carousel = document.getElementById(`category-${categoryId}`);

	if (!isVisible) {
		const $item = $carousel.querySelector('.carousel__item:not(.hide)');
		loadImage($item);
	}

	$carousel.classList.toggle('hide');
}

const $categoryButtons = document.querySelectorAll('[data-category-id]');
Array.from($categoryButtons).forEach(($categoryButton) => {
	$categoryButton.addEventListener('click', onClickCategory);
});
