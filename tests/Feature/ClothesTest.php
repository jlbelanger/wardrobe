<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClothesTest extends TestCase
{
	use RefreshDatabase;

	protected $path = '/api/clothes';

	protected function setUp() : void
	{
		parent::setUp();
		$this->clothes = \App\Models\Clothes::factory()->create();
		$this->user = \App\Models\User::factory()->create();
	}

	public function testIndex() : void
	{
		$response = $this->actingAs($this->user)->json('GET', $this->path);
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
				],
			],
		]);
		$response->assertStatus(200);
	}

	public function storeProvider() : array
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

	/**
	 * @dataProvider storeProvider
	 */
	public function testStore(array $args) : void
	{
		$category = \App\Models\Category::factory()->create(['name' => 'Dresses']);
		$colour = \App\Models\Colour::factory()->create(['name' => 'Red']);
		$args['body'] = $this->replaceToken('%category_id%', $category->id, $args['body']);
		$args['body'] = $this->replaceToken('%colour_id%', $colour->id, $args['body']);
		$args['response'] = $this->replaceToken('%category_id%', $category->id, $args['response']);
		$args['response'] = $this->replaceToken('%colour_id%', $colour->id, $args['response']);

		$response = $this->actingAs($this->user)->json('POST', $this->path, $args['body']);
		if (!empty($response['data']['id'])) {
			$args['response'] = $this->replaceToken('%id%', $response['data']['id'], $args['response']);
		}
		$response->assertExactJson($args['response']);
		$response->assertStatus($args['code']);
	}

	public function showProvider() : array
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

	/**
	 * @dataProvider showProvider
	 */
	public function testShow(array $args) : void
	{
		$args['response'] = $this->replaceToken('%id%', $this->clothes->id, $args['response']);
		$response = $this->actingAs($this->user)->json('GET', $this->path . '/' . $this->clothes->id);
		$response->assertExactJson($args['response']);
		$response->assertStatus($args['code']);
	}

	public function updateProvider() : array
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

	/**
	 * @dataProvider updateProvider
	 */
	public function testUpdate(array $args) : void
	{
		$category = \App\Models\Category::factory()->create(['name' => 'Dresses']);
		$colour = \App\Models\Colour::factory()->create(['name' => 'Red']);
		$args['body'] = $this->replaceToken('%id%', $this->clothes->id, $args['body']);
		$args['body'] = $this->replaceToken('%category_id%', $category->id, $args['body']);
		$args['body'] = $this->replaceToken('%colour_id%', $colour->id, $args['body']);
		$args['response'] = $this->replaceToken('%id%', $this->clothes->id, $args['response']);
		$args['response'] = $this->replaceToken('%category_id%', $category->id, $args['response']);
		$args['response'] = $this->replaceToken('%colour_id%', $colour->id, $args['response']);
		$response = $this->actingAs($this->user)->json('PUT', $this->path . '/' . $this->clothes->id, $args['body']);
		$response->assertExactJson($args['response']);
		$response->assertStatus($args['code']);
	}

	public function destroyProvider() : array
	{
		return [
			[[
				'code' => 204,
			]],
		];
	}

	/**
	 * @dataProvider destroyProvider
	 */
	public function testDestroy($args)
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
