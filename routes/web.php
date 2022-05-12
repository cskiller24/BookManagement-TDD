<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/login', function () {
//    return view('login');
//});
//Route::post('/login', function () {
//    validator(request()->all(), [
//        'email' => 'required',
//        'password' => 'required'
//    ])->validate();
//
//    $auth = \Illuminate\Support\Facades\Auth::attempt([
//        'email' => request('email'),
//        'password' => request('password')
//    ], true);
//
//    if($auth) {
//        return request()->user();
//    }
//    return abort(401);
//});
