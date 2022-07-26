<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="description" content="Re-creation of Cher's Wardrobe from the 1995 movie Clueless.">
		<meta name="keywords" content="cluesless, wardrobe, cher, movie">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta property="og:title" content="Jenny's Wardrobe">
		<meta property="og:image" content="{{ url('/assets/img/share.png') }}">
		<meta property="og:description" content="Re-creation of Cher's Wardrobe from the 1995 movie Clueless.">
		<title>Jenny's Wardrobe</title>
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
		<link rel="icon" href="/favicon.ico">
		<link rel="stylesheet" href="/assets/css/style.min.css?20220417">
	</head>
	<body>
		<noscript>This site requires Javascript to be enabled.</noscript>
		<div id="hangers">
			<div class="hanger"></div><div class="hanger"></div><div class="hanger"></div><div class="hanger"></div>
			<div class="hanger"></div><div class="hanger"></div><div class="hanger"></div><div class="hanger"></div>
			<div class="hanger"></div><div class="hanger"></div><div class="hanger"></div><div class="hanger"></div>
			<div class="hanger"></div><div class="hanger"></div><div class="hanger"></div><div class="hanger"></div>
			<div class="hanger"></div><div class="hanger"></div><div class="hanger"></div><div class="hanger"></div>
		</div>
		<main id="container">
			<header id="header">
				<h1 id="title">Jenny's Wardrobe</h1>
				<div id="seasons-container">
					<select aria-label="Season" data-default="{{ $currentSeasonId }}" id="seasons">
						@foreach ($seasons as $season)
							<option{{ $currentSeasonId === $season->id ? ' selected' : '' }} value="{{ $season->id }}">{{ $season->name }}</option>
						@endforeach
					</select>
				</div>
			</header>
			<article id="content">
				<div id="content-left">
					<button class="button button--large invisible" id="browse" type="button">Browse</button>
				</div>
				<div id="content-middle">
					@foreach ($categories as $category)
						<div
							class="carousel__container invisible{{ $category->is_default ? '' : ' hide' }}"
							id="category-{{ $category->slug }}"
						>
							<div class="carousel" data-index="0">
								<ul class="carousel__list">
									@foreach ($clothes[$category->id] as $i => $c)
										<li
											class="carousel__item{{ strpos($seasonsForClothes[$c->id], (string) $currentSeasonId) === false ? ' hide' : '' }}"
											data-colour-id="{{ $c->colour_id }}"
											data-season-ids="{{ $seasonsForClothes[$c->id] }}"
											@if ($i === 0 && $category->is_default)
												style="background-image:url('{{ $c->filename }}')"
											@else
												data-src="{{ $c->filename }}"
											@endif
										>
											{{ $c->name }}
										</li>
									@endforeach
								</ul>
							</div>
							<div class="carousel-controls">
								<button class="button carousel-button carousel-button--back" type="button">Back</button>
								<button class="button carousel-button carousel-button--randomize" type="button">Randomize</button>
								<button class="button carousel-button carousel-button--next" type="button">Next</button>
							</div>
						</div>
					@endforeach
				</div>
				<div id="content-right">
					<button class="button button--large invisible" id="dress-me" type="button">Dress Me</button>
				</div>
			</article>
			<footer id="footer">
				<fieldset id="footer-fieldset">
					<legend id="footer-legend">Categories</legend>
					<ul id="footer-list">
						@foreach ($categoriesFooter as $category)
							<li class="footer__item">
								<input
									class="category__checkbox"
									{{ $category->is_default ? 'checked data-default="1"' : '' }}
									id="category-input-{{ $category->slug }}"
									name="categories[]"
									type="checkbox"
									value="{{ $category->slug }}"
								/>
								<label class="category__label" for="category-input-{{ $category->slug }}">
									{{ $category->name }}
								</label>
							</li>
						@endforeach
					</ul>
				</fieldset>
				<a class="button" href="https://www.youtube.com/watch?v=XNDubWJU0aU" id="more">More</a>
			</footer>
			<div aria-label="Mismatch" aria-hint="" class="hide" id="mismatch-container" role="alert">
				<div id="mismatch" aria-hidden="true">Mis-match!</div>
			</div>
		</main>
		<script src="{{ url('/assets/js/functions.min.js?20220417') }}"></script>
	</body>
</html>
