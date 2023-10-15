<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jlbelanger\Tapioca\Traits\Resource;

class Season extends Model
{
	use HasFactory, Resource, SoftDeletes;

	protected $fillable = [
		'name',
		'start_date',
		'end_date',
		'order_num',
	];

	protected $casts = [
		'order_num' => 'integer',
	];

	/**
	 * @return array
	 */
	public function rules() : array
	{
		return [
			'data.attributes.name' => [$this->requiredOnCreate(), 'max:255', $this->unique('name')],
			'data.attributes.start_date' => [$this->requiredOnCreate(), 'regex:/^\d{2}-\d{2}$/'],
			'data.attributes.end_date' => [$this->requiredOnCreate(), 'regex:/^\d{2}-\d{2}$/'],
			'data.attributes.order_num' => [$this->requiredOnCreate(), 'integer'],
		];
	}
}
