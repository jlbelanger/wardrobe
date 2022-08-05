<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ColourFactory extends Factory
{
	/**
	 * Defines the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'name' => 'Yellow',
		];
	}
}
