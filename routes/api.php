<?php

use App\Http\Controllers\BookController;
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

Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\VerifyEmailController::class, 'verify'])->middleware(['throttle:6,1', 'signed'])->name('verification.verify');
Route::post('/email/verify/resend', [\App\Http\Controllers\VerifyEmailController::class, 'resend'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');

Route::post('/register', \App\Http\Controllers\Auth\RegisterController::class);
Route::post('/login', \App\Http\Controllers\Auth\LoginController::class);

Route::get("/auth", \App\Http\Controllers\Auth\AuthController::class)->middleware('auth:sanctum');

// Book api resource
Route::get('books', [\App\Http\Controllers\BookController::class, 'index']);
Route::post('books', [\App\Http\Controllers\BookController::class, 'store'])->middleware(['verified', 'auth:sanctum']);
Route::get('books/{book}', [\App\Http\Controllers\BookController::class, 'show']);
Route::put('books/{book}', [\App\Http\Controllers\BookController::class, 'update'])->middleware(['verified', 'auth:sanctum']);
Route::delete('books/{book}', [\App\Http\Controllers\BookController::class, 'destroy'])->middleware(['verified', 'auth:sanctum']);
Route::post('books/{book}/favorites', [\App\Http\Controllers\BookFavoriteController::class, 'store'])->middleware(['verified', 'auth:sanctum']);
Route::delete('books/{book}/favorites', [\App\Http\Controllers\BookFavoriteController::class, 'destroy'])->middleware(['verified', 'auth:sanctum']);

Route::get('genres', [\App\Http\Controllers\GenreController::class, 'index']);
Route::post('genres', [\App\Http\Controllers\GenreController::class, 'store'])->middleware(['verified', 'auth:sanctum']);
Route::put('genres/{genre}', [\App\Http\Controllers\GenreController::class, 'update'])->middleware(['verified', 'auth:sanctum']);
Route::delete('genres/{genre}', [\App\Http\Controllers\GenreController::class, 'destroy'])->middleware(['verified', 'auth:sanctum']);

Route::post('books/{book}/images', [\App\Http\Controllers\BookImageController::class, 'store'])->middleware(['verified', 'auth:sanctum']);
Route::put('books/{book}/images/{image}', [\App\Http\Controllers\BookImageController::class, 'update'])->middleware(['verified', 'auth:sanctum']);
Route::delete('books/{book}/images/{image}', [\App\Http\Controllers\BookImageController::class, 'destroy'])->middleware(['verified', 'auth:sanctum']);

Route::get('books/{book}/reviews', [\App\Http\Controllers\ReviewController::class, 'index'])->middleware(['verified', 'auth:sanctum']);
Route::post('books/{book}/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->middleware(['verified', 'auth:sanctum']);
Route::get('books/{book}/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'show'])->middleware(['verified', 'auth:sanctum']);
Route::put('books/{book}/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'update'])->middleware(['verified', 'auth:sanctum']);
Route::delete('books/{book}/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->middleware(['verified', 'auth:sanctum']);

Route::get('reviews', [\App\Http\Controllers\ReviewController::class, 'userIndex'])->middleware(['auth:sanctum', 'verified']);

Route::get('/test', [BookController::class, 'test']);
