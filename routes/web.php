<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Friendship\AcceptFriendController;
use App\Http\Controllers\Friendship\AddFriendController;
use App\Http\Controllers\Friendship\DeclineFriendController;
use App\Http\Controllers\Friendship\RemoveFriendController;
use App\Http\Controllers\Messages\NewMessageController;
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
    Route::get('/', DashboardController::class);
    Route::post('add_friend', AddFriendController::class);
    Route::get('chat/{friendship}', ChatController::class);
    Route::post('chat/{friendship}', NewMessageController::class);
    Route::patch('accept_friend/{friendship}', AcceptFriendController::class);
    Route::delete('decline_friend/{friendship}', RemoveFriendController::class);
    Route::delete('remove_friend/{friendship}', RemoveFriendController::class);
});

Route::group(['middleware' => ['guest']], function () {
    Route::view('login', 'auth.login')->name('login');
    Route::post('login', LoginController::class);
    Route::view('register', 'auth.register');
    Route::post('register', RegisterController::class);
});
