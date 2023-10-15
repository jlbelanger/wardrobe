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
	 * @return array
	 */
	public function rules() : array
	{
		return [
			'data.attributes.name' => [$this->requiredOnCreate(), 'max:255', $this->unique('name')],
			'data.relationships.category' => [$this->requiredOnCreate()],
			'data.relationships.colour' => [$this->requiredOnCreate()],
			'data.attributes.is_default' => ['boolean'],
			'data.attributes.is_patterned' => ['boolean'],
		];
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
		$name = !empty($data['attributes']['name']) ? $data['attributes']['name'] : $this->name;
		$pathInfo = pathinfo($filename);
		$extension = strtolower($pathInfo['extension']);
		if ($extension === 'jpeg') {
			$extension = 'jpg';
		}
		return '/uploads/clothes/' . strtolower(Str::random(8)) . '/' . Str::kebab($name) . '.' . $extension;
	}
}
