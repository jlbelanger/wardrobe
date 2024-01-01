<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return response()->json(['success' => true]);
});

Route::group(['middleware' => ['api', 'guest', 'throttle:auth']], function () {
	Route::post('/auth/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
	Route::post('/auth/forgot-password', [\App\Http\Controllers\Api\AuthController::class, 'forgotPassword']);
	Route::put('/auth/reset-password/{token}', [\App\Http\Controllers\Api\AuthController::class, 'resetPassword'])->middleware('signed:relative')->name('password.update');
});

Route::group(['middleware' => ['api', 'auth:sanctum']], function () {
	Route::delete('/auth/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
	Route::put('/auth/change-email', [\App\Http\Controllers\Api\AuthController::class, 'changeEmail']);
	Route::put('/auth/change-password', [\App\Http\Controllers\Api\AuthController::class, 'changePassword']);

	Route::apiResources([
		'categories' => \App\Http\Controllers\Api\CategoryController::class,
		'clothes' => \App\Http\Controllers\Api\ClothesController::class,
		'colours' => \App\Http\Controllers\Api\ColourController::class,
		'seasons' => \App\Http\Controllers\Api\SeasonController::class,
		'users' => \App\Http\Controllers\Api\UserController::class,
	]);
});
