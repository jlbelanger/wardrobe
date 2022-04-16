function onChangeSeason(e) {
	const seasonId = e.target.value;
	const $clothes = document.querySelectorAll('[data-season-ids]');

	Array.from($clothes).forEach(($c) => {
		if ($c.getAttribute('data-season-ids').includes(seasonId)) {
			$c.classList.remove('hide');
		} else {
			$c.classList.add('hide');
		}
	});
}

const $seasons = document.getElementById('seasons');
$seasons.addEventListener('change', onChangeSeason);
