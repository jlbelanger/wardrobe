<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="description" content="Re-creation of Cher's Wardrobe from the 1995 movie Clueless.">
		<meta name="keywords" content="cluesless, wardrobe, cher, movie">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta property="og:title" content="Jenny's Wardrobe">
		<meta property="og:image" content="{{ url('/assets/img/share.jpg') }}">
		<meta property="og:description" content="Re-creation of Cher's Wardrobe from the 1995 movie Clueless.">
		<title>Jenny's Wardrobe</title>
		<link rel="icon" href="{{ url('/favicon.svg') }}">
		<link rel="stylesheet" href="{{ url('/assets/css/style.min.css?20220325') }}">
	</head>
	<body>
		<main id="container">
			<noscript>This site requires Javascript to be enabled.</noscript>
			<header id="header">
				<h1 id="title">Jenny's Wardrobe</h1>
				<div id="seasons-container">
					<select id="seasons">
						@foreach ($seasons as $season)
							<option{{ $currentSeasonId === $season->id ? ' selected' : '' }} value="{{ $season->id }}">{{ $season->name }}</option>
						@endforeach
					</select>
				</div>
			</header>
			<article id="content">
				<div id="content-left">
					<button class="button button--large" id="browse" type="button">Browse</button>
				</div>
				<div id="content-middle">
					@foreach ($categories as $category)
						<div
							class="carousel__container{{ $category->is_default ? '' : ' hide' }}"
							id="category-{{ $category->id }}"
						>
							<div class="carousel" data-index="0">
								<ul class="carousel__list">
									@foreach ($clothes[$category->id] as $i => $c)
										<li
											class="carousel__item{{ strpos($seasonsForClothes[$c->id], (string) $currentSeasonId) === false ? ' hide' : '' }}"
											data-colour-id="{{ $c->colour_id }}"
											data-season-ids="{{ $seasonsForClothes[$c->id] }}"
										>
											<img alt="{{ $c->name }}" {{ $i === 0 && $category->is_default ? '' : 'data-' }}src="{{ $c->filename }}" />
										</li>
									@endforeach
								</ul>
							</div>
							<div class="carousel-controls">
								<button aria-label="Back" class="button carousel-button carousel-button--back" type="button"></button>
								<button aria-label="OK" class="button carousel-button carousel-button--ok" type="button"></button>
								<button aria-label="Next" class="button carousel-button carousel-button--next" type="button"></button>
							</div>
						</div>
					@endforeach
				</div>
				<div id="content-right">
					<button class="button button--large" id="dress-me" type="button">Dress Me</button>
				</div>
			</article>
			<footer id="footer">
				<ul id="footer-list">
					@foreach ($categoriesFooter as $category)
						<li class="footer__item">
							<button
								class="footer__link{{ $category->is_default ? ' footer__link--active' : '' }}"
								data-category-id="{{ $category->id }}"
								type="button"
							>
								{{ $category->name }}
							</button>
						</li>
					@endforeach
				</ul>
				<a class="button" href="https://www.youtube.com/watch?v=XNDubWJU0aU" id="more">More</a>
			</footer>
			<div class="hide" id="mismatch-container"><div id="mismatch">Mis-match!</div></div>
		</main>
		<script src="{{ url('/assets/js/functions.min.js?20220325') }}"></script>
	</body>
</html>
