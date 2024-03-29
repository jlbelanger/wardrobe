<?php

use App\Models\Category;
use App\Models\Clothes;
use App\Models\Season;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	$categories = Category::all()->keyBy('id');
	$seasons = Season::all();
	$clothes = Clothes::orderBy('is_default', 'desc')->get();

	$clothesByCategory = [];
	$categoriesOutput = [];
	$categoriesFooter = [];
	$orderNums = [];
	$orderNumsFooter = [];
	$seasonsForClothes = [];

	foreach ($clothes as $c) {
		if (empty($clothesByCategory[$c->category_id])) {
			$clothesByCategory[$c->category_id] = [];
			$categoriesOutput[] = $categories[$c->category_id];
			$categoriesFooter[] = $categories[$c->category_id];
			$orderNums[] = $categories[$c->category_id]->order_num;
			$orderNumsFooter[] = $categories[$c->category_id]->order_num_footer;
		}
		$clothesByCategory[$c->category_id][] = $c;
		$seasonsForClothes[$c->id] = [];
	}

	array_multisort($orderNumsFooter, SORT_ASC, $categoriesFooter);
	array_multisort($orderNums, SORT_ASC, $categoriesOutput);

	$clothesSeasons = DB::table('clothes_season')->get();
	foreach ($clothesSeasons as $c) {
		$seasonsForClothes[$c->clothes_id][] = $c->season_id;
	}
	foreach ($seasonsForClothes as $clothesId => $seasonIds) {
		$seasonsForClothes[$clothesId] = implode(',', $seasonIds);
	}

	return view('home')
		->with('categories', $categoriesOutput)
		->with('categoriesFooter', $categoriesFooter)
		->with('clothes', $clothesByCategory)
		->with('currentSeasonId', 3)
		->with('seasons', $seasons)
		->with('seasonsForClothes', $seasonsForClothes);
});
