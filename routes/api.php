<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/users', function (Request $request) {
    return $request->user();
})->middleware(['auth:sanctum']);

Route::post('/register', \App\Http\Controllers\Auth\RegisterController::class);
Route::post('/login', \App\Http\Controllers\Auth\LoginController::class);

Route::apiResource('books', \App\Http\Controllers\BookController::class);
Route::get('genres', [\App\Http\Controllers\GenreController::class, 'index']);
Route::get('reviews', [\App\Http\Controllers\ReviewController::class, 'index']);
