<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Jlbelanger\Tapioca\Traits\Resource;

class Category extends Model
{
	use HasFactory, Resource;

	protected $fillable = [
		'name',
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
	 * @param  array  $data
	 * @param  string $method
	 * @return array
	 */
	protected function rules(array $data, string $method) : array // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundInExtendedClassBeforeLastUsed
	{
		$required = $method === 'POST' ? 'required' : 'filled';
		$rules = [
			'attributes.name' => [$required, 'max:255'],
			'attributes.order_num' => [$required, 'integer'],
			'attributes.order_num_footer' => [$required, 'integer'],
			'attributes.is_default' => ['boolean'],
		];

		$unique = Rule::unique($this->getTable(), 'name');
		if ($this->id) {
			$unique->ignore($this->id);
		}
		$rules['attributes.name'][] = $unique;

		return $rules;
	}
}
