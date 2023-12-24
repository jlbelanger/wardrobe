<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ColourTest extends TestCase
{
	use RefreshDatabase;

	protected $path = '/api/colours';

	protected function setUp() : void
	{
		parent::setUp();
		$this->colour = \App\Models\Colour::factory()->create();
		$this->user = \App\Models\User::factory()->create();
	}

	public function testIndex() : void
	{
		$response = $this->actingAs($this->user)->json('GET', $this->path);
		$response->assertExactJson([
			'data' => [
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
						'type' => 'colours',
						'attributes' => [
							'name' => 'Red',
						],
					],
				],
				'response' => [
					'data' => [
						'id' => '%id%',
						'type' => 'colours',
						'attributes' => [
							'name' => 'Red',
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

	public static function showProvider() : array
	{
		return [
			[[
				'response' => [
					'data' => [
						'id' => '%id%',
						'type' => 'colours',
						'attributes' => [
							'name' => 'Yellow',
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
		$args['response'] = $this->replaceToken('%id%', (string) $this->colour->id, $args['response']);
		$response = $this->actingAs($this->user)->json('GET', $this->path . '/' . $this->colour->id);
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
						'type' => 'colours',
						'attributes' => [
							'name' => 'Red',
						],
					],
				],
				'response' => [
					'data' => [
						'id' => '%id%',
						'type' => 'colours',
						'attributes' => [
							'name' => 'Red',
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
		$args['body'] = $this->replaceToken('%id%', (string) $this->colour->id, $args['body']);
		$args['response'] = $this->replaceToken('%id%', (string) $this->colour->id, $args['response']);
		$response = $this->actingAs($this->user)->json('PUT', $this->path . '/' . $this->colour->id, $args['body']);
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

	/**
	 * @dataProvider destroyProvider
	 */
	public function testDestroy(array $args) : void
	{
		$response = $this->actingAs($this->user)->json('DELETE', $this->path . '/' . $this->colour->id);
		if (!empty($args['response'])) {
			$response->assertExactJson($args['response']);
			$response->assertStatus($args['code']);
		} else {
			$response->assertNoContent($args['code']);
		}
	}
}
