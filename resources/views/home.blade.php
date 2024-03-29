<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="description" content="Re-creation of Cher's Wardrobe from the 1995 movie Clueless.">
		<meta name="keywords" content="cluesless, wardrobe, cher, movie">
		<meta property="og:title" content="Jenny's Wardrobe">
		<meta property="og:description" content="Re-creation of Cher's Wardrobe from the 1995 movie Clueless.">
		<meta property="og:image" content="{{ url('/assets/img/share.png') }}">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-2048-2732.png') }}" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-1668-2388.png') }}" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-1536-2048.png') }}" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-1668-2224.png') }}" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-1620-2160.png') }}" media="(device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-1290-2796.png') }}" media="(device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-1179-2556.png') }}" media="(device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-1284-2778.png') }}" media="(device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-1170-2532.png') }}" media="(device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-1125-2436.png') }}" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-1242-2688.png') }}" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-828-1792.png') }}" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-1242-2208.png') }}" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-750-1334.png') }}" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
		<link rel="apple-touch-startup-image" href="{{ url('/assets/img/splash/apple-splash-640-1136.png') }}" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
		<title>Jenny's Wardrobe</title>
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
		<link rel="icon" href="/favicon.ico">
		<link rel="stylesheet" href="{{ mix('/assets/css/style.min.css') }}">
		<link rel="manifest" href="/manifest.json">
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
		<main id="main">
			<header id="header">
				<h1 id="title">Jenny's Wardrobe</h1>
				<div id="seasons-container">
					<select aria-label="Season" data-default="{{ $currentSeasonId }}" id="seasons">
						@foreach ($seasons as $season)
							<option{{ $currentSeasonId === $season->id ? ' selected' : '' }} value="{{ $season->id }}">{{ $season->name }}</option>
						@endforeach
					</select>
				</div>
				<a class="button" href="https://github.com/jlbelanger/wardrobe" id="github">GitHub</a>
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
		<script src="{{ mix('/assets/js/functions.min.js') }}"></script>
	</body>
</html>
