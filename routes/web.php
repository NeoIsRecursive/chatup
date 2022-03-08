<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::group(['middleware' => ['auth']], function () {
    Route::view('/', 'dashboard');
});
Route::group(['middleware' => ['guest']], function () {
    Route::view('login', 'auth.login')->name('login');
    Route::post('login', LoginController::class);
    Route::view('register', 'auth.register');
    Route::post('register', RegisterController::class);
});