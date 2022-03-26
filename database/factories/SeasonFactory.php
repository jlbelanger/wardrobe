<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'name' => 'Fall Fashions',
			'start_date' => '09-22',
			'end_date' => '12-20',
			'order_num' => 3,
		];
	}
}
