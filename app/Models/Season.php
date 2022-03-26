<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
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
	 * @param  array  $data
	 * @param  string $method
	 * @return array
	 */
	protected function rules(array $data, string $method) : array // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundInExtendedClassBeforeLastUsed
	{
		$required = $method === 'POST' ? 'required' : 'filled';
		$rules = [
			'attributes.name' => [$required, 'max:255'],
			'attributes.start_date' => [$required, 'regex:/^\d{2}-\d{2}$/'],
			'attributes.end_date' => [$required, 'regex:/^\d{2}-\d{2}$/'],
			'attributes.order_num' => [$required, 'integer'],
		];

		$unique = Rule::unique($this->getTable(), 'name');
		if ($this->id) {
			$unique->ignore($this->id);
		}
		$rules['attributes.name'][] = $unique;

		return $rules;
	}
}
