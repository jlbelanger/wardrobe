<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jlbelanger\Tapioca\Traits\Resource;

class Colour extends Model
{
	use HasFactory, Resource, SoftDeletes;

	protected $fillable = [
		'name',
	];

	/**
	 * @return array
	 */
	public function rules() : array
	{
		return [
			'data.attributes.name' => [$this->requiredOnCreate(), 'max:255', $this->unique('name')],
		];
	}
}
