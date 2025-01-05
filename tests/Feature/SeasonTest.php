<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SeasonTest extends TestCase
{
	use RefreshDatabase;

	protected $path = '/api/seasons';

	protected $season;

	protected $user;

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
						'order_num' => 0,
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
						'type' => 'seasons',
						'attributes' => [
							'name' => 'Winter Wear',
							'start_date' => '12-21',
							'end_date' => '03-19',
							'order_num' => 0,
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
							'order_num' => 0,
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
						'type' => 'seasons',
						'attributes' => [
							'name' => 'Fall Fashions',
							'start_date' => '09-22',
							'end_date' => '12-20',
							'order_num' => 0,
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
		$args['response'] = $this->replaceToken('%id%', (string) $this->season->id, $args['response']);
		$response = $this->actingAs($this->user)->json('GET', $this->path . '/' . $this->season->id);
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
						'type' => 'seasons',
						'attributes' => [
							'name' => 'Winter Wear',
							'start_date' => '12-21',
							'end_date' => '03-19',
							'order_num' => 0,
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
							'order_num' => 0,
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
		$args['body'] = $this->replaceToken('%id%', (string) $this->season->id, $args['body']);
		$args['response'] = $this->replaceToken('%id%', (string) $this->season->id, $args['response']);
		$response = $this->actingAs($this->user)->json('PUT', $this->path . '/' . $this->season->id, $args['body']);
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
		$response = $this->actingAs($this->user)->json('DELETE', $this->path . '/' . $this->season->id);
		if (!empty($args['response'])) {
			$response->assertExactJson($args['response']);
			$response->assertStatus($args['code']);
		} else {
			$response->assertNoContent($args['code']);
		}
	}
}
