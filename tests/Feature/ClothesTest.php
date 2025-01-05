<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ClothesTest extends TestCase
{
	use RefreshDatabase;

	protected $path = '/api/clothes';

	protected $category;

	protected $colour;

	protected $clothes;

	protected $user;

	protected function setUp() : void
	{
		parent::setUp();
		$this->category = \App\Models\Category::factory()->create();
		$this->colour = \App\Models\Colour::factory()->create();
		$this->clothes = \App\Models\Clothes::factory()->create([
			'category_id' => $this->category->getKey(),
			'colour_id' => $this->colour->getKey(),
		]);
		$this->user = \App\Models\User::factory()->create();
	}

	public function testIndex() : void
	{
		$response = $this->actingAs($this->user)->json('GET', $this->path . '?include=category,colour,seasons');
		$response->assertExactJson([
			'data' => [
				[
					'id' => (string) $this->clothes->id,
					'type' => 'clothes',
					'attributes' => [
						'name' => 'Yellow Plaid Skirt',
						'filename' => '/uploads/clothes/yellow-plaid-skirt.png',
						'is_default' => false,
						'is_patterned' => false,
					],
					'relationships' => [
						'category' => [
							'data' => [
								'id' => (string) $this->category->id,
								'type' => 'categories',
							],
						],
						'colour' => [
							'data' => [
								'id' => (string) $this->colour->id,
								'type' => 'colours',
							],
						],
						'seasons' => [
							'data' => [],
						],
					],
				],
			],
			'included' => [
				[
					'id' => (string) $this->category->id,
					'type' => 'categories',
					'attributes' => [
						'name' => 'Skirts',
						'slug' => 'skirts',
						'order_num' => 0,
						'order_num_footer' => 0,
						'is_default' => false,
					],
				],
				[
					'id' => (string) $this->colour->id,
					'type' => 'colours',
					'attributes' => [
						'name' => 'Yellow',
					],
				],
			],
		]);
		$response->assertStatus(200);
	}

	public static function storeProvider() : array
	{
		return [
			[[
				'body' => [
					'data' => [
						'type' => 'clothes',
						'attributes' => [
							'name' => 'Red Dress',
							'filename' => '/uploads/clothes/red-dress.png',
							'is_default' => false,
							'is_patterned' => false,
						],
						'relationships' => [
							'category' => [
								'data' => [
									'id' => '%category_id%',
									'type' => 'categories',
								],
							],
							'colour' => [
								'data' => [
									'id' => '%colour_id%',
									'type' => 'colours',
								],
							],
						],
					],
				],
				'response' => [
					'data' => [
						'id' => '%id%',
						'type' => 'clothes',
						'attributes' => [
							'name' => 'Red Dress',
							'filename' => '/uploads/clothes/red-dress.png',
							'is_default' => false,
							'is_patterned' => false,
						],
					],
				],
				'code' => 201,
			]],
		];
	}

	#[DataProvider('storeProvider')]
	public function testStore(array $args) : void
	{
		$category = \App\Models\Category::factory()->create(['name' => 'Dresses']);
		$colour = \App\Models\Colour::factory()->create(['name' => 'Red']);
		$args['body'] = $this->replaceToken('%category_id%', (string) $category->id, $args['body']);
		$args['body'] = $this->replaceToken('%colour_id%', (string) $colour->id, $args['body']);
		$args['response'] = $this->replaceToken('%category_id%', (string) $category->id, $args['response']);
		$args['response'] = $this->replaceToken('%colour_id%', (string) $colour->id, $args['response']);

		$response = $this->actingAs($this->user)->json('POST', $this->path, $args['body']);
		if (!empty($response['data']['id'])) {
			$args['response'] = $this->replaceToken('%id%', $response['data']['id'], $args['response']);
		}
		$response->assertExactJson($args['response']);
		$response->assertStatus($args['code']);
	}

	public static function showProvider() : array
	{
		return [
			[[
				'response' => [
					'data' => [
						'id' => '%id%',
						'type' => 'clothes',
						'attributes' => [
							'name' => 'Yellow Plaid Skirt',
							'filename' => '/uploads/clothes/yellow-plaid-skirt.png',
							'is_default' => false,
							'is_patterned' => false,
						],
					],
				],
				'code' => 200,
			]],
		];
	}

	#[DataProvider('showProvider')]
	public function testShow(array $args) : void
	{
		$args['response'] = $this->replaceToken('%id%', (string) $this->clothes->id, $args['response']);
		$response = $this->actingAs($this->user)->json('GET', $this->path . '/' . $this->clothes->id);
		$response->assertExactJson($args['response']);
		$response->assertStatus($args['code']);
	}

	public static function updateProvider() : array
	{
		return [
			[[
				'body' => [
					'data' => [
						'id' => '%id%',
						'type' => 'clothes',
						'attributes' => [
							'name' => 'Red Dress',
							'filename' => '/uploads/clothes/red-dress.png',
							'is_default' => false,
							'is_patterned' => false,
						],
						'relationships' => [
							'category' => [
								'data' => [
									'id' => '%category_id%',
									'type' => 'categories',
								],
							],
							'colour' => [
								'data' => [
									'id' => '%colour_id%',
									'type' => 'colours',
								],
							],
						],
					],
				],
				'response' => [
					'data' => [
						'id' => '%id%',
						'type' => 'clothes',
						'attributes' => [
							'name' => 'Red Dress',
							'filename' => '/uploads/clothes/red-dress.png',
							'is_default' => false,
							'is_patterned' => false,
						],
					],
				],
				'code' => 200,
			]],
		];
	}

	#[DataProvider('updateProvider')]
	public function testUpdate(array $args) : void
	{
		$category = \App\Models\Category::factory()->create(['name' => 'Dresses']);
		$colour = \App\Models\Colour::factory()->create(['name' => 'Red']);
		$args['body'] = $this->replaceToken('%id%', (string) $this->clothes->id, $args['body']);
		$args['body'] = $this->replaceToken('%category_id%', (string) $category->id, $args['body']);
		$args['body'] = $this->replaceToken('%colour_id%', (string) $colour->id, $args['body']);
		$args['response'] = $this->replaceToken('%id%', (string) $this->clothes->id, $args['response']);
		$args['response'] = $this->replaceToken('%category_id%', (string) $category->id, $args['response']);
		$args['response'] = $this->replaceToken('%colour_id%', (string) $colour->id, $args['response']);
		$response = $this->actingAs($this->user)->json('PUT', $this->path . '/' . $this->clothes->id, $args['body']);
		$response->assertExactJson($args['response']);
		$response->assertStatus($args['code']);
	}

	public static function destroyProvider() : array
	{
		return [
			[[
				'code' => 204,
			]],
		];
	}

	#[DataProvider('destroyProvider')]
	public function testDestroy(array $args) : void
	{
		$response = $this->actingAs($this->user)->json('DELETE', $this->path . '/' . $this->clothes->id);
		if (!empty($args['response'])) {
			$response->assertExactJson($args['response']);
			$response->assertStatus($args['code']);
		} else {
			$response->assertNoContent($args['code']);
		}
	}
}
