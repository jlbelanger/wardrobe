<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonFactory extends Factory
{
	/**
	 * Defines the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition() : array
	{
		return [
			'name' => 'Fall Fashions',
			'start_date' => '09-22',
			'end_date' => '12-20',
		];
	}
}
