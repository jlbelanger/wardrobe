<?php

use Illuminate\Support\Facades\Route;
use Jlbelanger\Tapioca\Exceptions\NotFoundException;

Route::get('/', function () {
	return response()->json(['success' => true]);
});

Route::group(['middleware' => ['api', 'guest', 'throttle:' . config('auth.throttle_max_attempts') . ',1']], function () {
	Route::post('/auth/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
	Route::post('/auth/forgot-password', [\App\Http\Controllers\Api\AuthController::class, 'forgotPassword']);
	Route::put('/auth/reset-password/{token}', [\App\Http\Controllers\Api\AuthController::class, 'resetPassword']);
});

Route::group(['middleware' => ['api', 'auth:sanctum']], function () {
	Route::delete('/auth/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

	Route::apiResources([
		'categories' => \App\Http\Controllers\Api\CategoryController::class,
		'clothes' => \App\Http\Controllers\Api\ClothesController::class,
		'colours' => \App\Http\Controllers\Api\ColourController::class,
		'seasons' => \App\Http\Controllers\Api\SeasonController::class,
		'users' => \App\Http\Controllers\Api\UserController::class,
	]);
});

Route::fallback(function () {
	throw NotFoundException::generate();
});
