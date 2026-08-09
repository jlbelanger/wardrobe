<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Colour;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClothesFactory extends Factory
{
	public function definition() : array
	{
		return [
			'name' => 'Yellow Plaid Skirt',
			'filename' => '/uploads/clothes/yellow-plaid-skirt.png',
			'category_id' => Category::factory(),
			'colour_id' => Colour::factory(),
		];
	}
}
