<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Colour;
use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Jlbelanger\Tapioca\Traits\Resource;

class Clothes extends Model
{
	use HasFactory, Resource, SoftDeletes;

	protected $fillable = [
		'name',
		'filename',
		'category_id',
		'colour_id',
		'is_default',
		'is_patterned',
	];

	protected $casts = [
		'category_id' => 'integer',
		'colour_id' => 'integer',
		'is_default' => 'boolean',
		'is_patterned' => 'boolean',
	];

	/**
	 * @return BelongsTo
	 */
	public function category() : BelongsTo
	{
		return $this->belongsTo(Category::class, 'category_id');
	}

	/**
	 * @return BelongsTo
	 */
	public function colour() : BelongsTo
	{
		return $this->belongsTo(Colour::class, 'colour_id');
	}

	/**
	 * @return array
	 */
	public function multiRelationships() : array
	{
		return ['seasons'];
	}

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
			'relationships.category.data.id' => [$required, 'integer'],
			'relationships.colour.data.id' => [$required, 'integer'],
			'attributes.is_default' => ['boolean'],
			'attributes.is_patterned' => ['boolean'],
		];

		$unique = Rule::unique($this->getTable(), 'name');
		if ($this->id) {
			$unique->ignore($this->id);
		}
		$rules['attributes.name'][] = $unique;

		return $rules;
	}

	/**
	 * @return BelongsToMany
	 */
	public function seasons() : BelongsToMany
	{
		return $this->belongsToMany(Season::class);
	}

	/**
	 * @return array
	 */
	public function singularRelationships() : array
	{
		return ['category', 'colour'];
	}

	/**
	 * @param  string $key
	 * @param  string $filename
	 * @param  array  $data
	 * @return string
	 */
	public function uploadedFilename(string $key, string $filename, array $data = []) : string // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundInExtendedClassBeforeLastUsed
	{
		$name = !empty($data) ? $data['attributes']['name'] : $this->name;
		$pathInfo = pathinfo($filename);
		return '/uploads/clothes/' . Str::kebab($name) . '.' . $pathInfo['extension'];
	}
}
