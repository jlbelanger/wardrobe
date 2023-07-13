import { onScrollList } from './scroll';

export const onChangeSeason = (e) => {
	const seasonId = e.target.value;
	const $clothes = document.querySelectorAll('[data-season-ids]');

	Array.from($clothes).forEach(($c) => {
		if ($c.getAttribute('data-season-ids').includes(seasonId)) {
			$c.classList.remove('hide');
		} else {
			$c.classList.add('hide');
		}
	});

	const $lists = document.querySelectorAll('.carousel__list');
	Array.from($lists).forEach(($list) => {
		onScrollList({ target: $list });
	});
};

export const initSeasons = () => {
	const $seasons = document.getElementById('seasons');
	$seasons.addEventListener('change', onChangeSeason);
};
