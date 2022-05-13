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

Route::get('/test', function () {
//    return \App\Models\User::with('books')->get();
//    return \App\Models\Book::with('user')->get();
//    return \App\Models\User::query()->With('favorites')->get();
//    return \App\Models\User::query()->withCount('favorites')->get();
//    return \App\Models\Book::with('user')->get();
//    return \App\Models\Book::with('reviews')->get();
//    return \App\Models\Book::query()->withCount('favorites')->get();
//    return \App\Models\Book::query()->with('genre')->get();
//    return \App\Models\Review::query()->with('book')->get();
//    return \App\Models\Genre::query()->with('books')->get();
    return null;
});
