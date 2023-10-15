<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jlbelanger\Tapioca\Traits\Resource;

class Category extends Model
{
	use HasFactory, Resource, SoftDeletes;

	protected $fillable = [
		'name',
		'slug',
		'order_num',
		'order_num_footer',
		'is_default',
	];

	protected $casts = [
		'order_num' => 'integer',
		'order_num_footer' => 'integer',
		'is_default' => 'boolean',
	];

	/**
	 * @return array
	 */
	public function rules() : array
	{
		return [
			'data.attributes.name' => [$this->requiredOnCreate(), 'max:255', $this->unique('name')],
			'data.attributes.slug' => [$this->requiredOnCreate(), 'max:255', 'regex:/^[a-z0-9-]+$/', $this->unique('slug')],
			'data.attributes.order_num' => [$this->requiredOnCreate(), 'integer'],
			'data.attributes.order_num_footer' => [$this->requiredOnCreate(), 'integer'],
			'data.attributes.is_default' => ['boolean'],
		];
	}
}
