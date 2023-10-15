<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
	use RefreshDatabase;

	protected $path = '/api/categories';

	protected function setUp() : void
	{
		parent::setUp();
		$this->category = \App\Models\Category::factory()->create();
		$this->user = \App\Models\User::factory()->create();
	}

	public function testIndex() : void
	{
		$response = $this->actingAs($this->user)->json('GET', $this->path);
		$response->assertExactJson([
			'data' => [
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
						'type' => 'categories',
						'attributes' => [
							'name' => 'Dresses',
							'slug' => 'dresses',
							'order_num' => 0,
							'order_num_footer' => 0,
							'is_default' => false,
						],
					],
				],
				'response' => [
					'data' => [
						'id' => '%id%',
						'type' => 'categories',
						'attributes' => [
							'name' => 'Dresses',
							'slug' => 'dresses',
							'order_num' => 0,
							'order_num_footer' => 0,
							'is_default' => false,
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
						'type' => 'categories',
						'attributes' => [
							'name' => 'Skirts',
							'slug' => 'skirts',
							'order_num' => 0,
							'order_num_footer' => 0,
							'is_default' => false,
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
		$args['response'] = $this->replaceToken('%id%', (string) $this->category->id, $args['response']);
		$response = $this->actingAs($this->user)->json('GET', $this->path . '/' . $this->category->id);
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
						'type' => 'categories',
						'attributes' => [
							'name' => 'Dresses',
							'slug' => 'dresses',
							'order_num' => 0,
							'order_num_footer' => 0,
							'is_default' => false,
						],
					],
				],
				'response' => [
					'data' => [
						'id' => '%id%',
						'type' => 'categories',
						'attributes' => [
							'name' => 'Dresses',
							'slug' => 'dresses',
							'order_num' => 0,
							'order_num_footer' => 0,
							'is_default' => false,
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
		$args['body'] = $this->replaceToken('%id%', (string) $this->category->id, $args['body']);
		$args['response'] = $this->replaceToken('%id%', (string) $this->category->id, $args['response']);
		$response = $this->actingAs($this->user)->json('PUT', $this->path . '/' . $this->category->id, $args['body']);
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
	public function testDestroy(array $args) : void
	{
		$response = $this->actingAs($this->user)->json('DELETE', $this->path . '/' . $this->category->id);
		if (!empty($args['response'])) {
			$response->assertExactJson($args['response']);
			$response->assertStatus($args['code']);
		} else {
			$response->assertNoContent($args['code']);
		}
	}
}
