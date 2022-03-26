<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeasonTest extends TestCase
{
	use RefreshDatabase;

	protected $path = '/api/seasons';

	protected function setUp() : void
	{
		parent::setUp();
		$this->season = \App\Models\Season::factory()->create();
		$this->user = \App\Models\User::factory()->create();
	}

	public function testIndex() : void
	{
		$response = $this->actingAs($this->user)->json('GET', $this->path);
		$response->assertExactJson([
			'data' => [
				[
					'id' => (string) $this->season->id,
					'type' => 'seasons',
					'attributes' => [
						'name' => 'Fall Fashions',
						'start_date' => '09-22',
						'end_date' => '12-20',
						'order_num' => 3,
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
						'type' => 'seasons',
						'attributes' => [
							'name' => 'Winter Wear',
							'start_date' => '12-21',
							'end_date' => '03-19',
							'order_num' => 4,
						],
					],
				],
				'response' => [
					'data' => [
						'id' => '%id%',
						'type' => 'seasons',
						'attributes' => [
							'name' => 'Winter Wear',
							'start_date' => '12-21',
							'end_date' => '03-19',
							'order_num' => 4,
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
						'type' => 'seasons',
						'attributes' => [
							'name' => 'Fall Fashions',
							'start_date' => '09-22',
							'end_date' => '12-20',
							'order_num' => 3,
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
		$args['response'] = $this->replaceToken('%id%', $this->season->id, $args['response']);
		$response = $this->actingAs($this->user)->json('GET', $this->path . '/' . $this->season->id);
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
						'type' => 'seasons',
						'attributes' => [
							'name' => 'Winter Wear',
							'start_date' => '12-21',
							'end_date' => '03-19',
							'order_num' => 4,
						],
					],
				],
				'response' => [
					'data' => [
						'id' => '%id%',
						'type' => 'seasons',
						'attributes' => [
							'name' => 'Winter Wear',
							'start_date' => '12-21',
							'end_date' => '03-19',
							'order_num' => 4,
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
		$args['body'] = $this->replaceToken('%id%', $this->season->id, $args['body']);
		$args['response'] = $this->replaceToken('%id%', $this->season->id, $args['response']);
		$response = $this->actingAs($this->user)->json('PUT', $this->path . '/' . $this->season->id, $args['body']);
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
		$response = $this->actingAs($this->user)->json('DELETE', $this->path . '/' . $this->season->id);
		if (!empty($args['response'])) {
			$response->assertExactJson($args['response']);
			$response->assertStatus($args['code']);
		} else {
			$response->assertNoContent($args['code']);
		}
	}
}
