<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BlockController;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/tweet/search/input', [SearchController::class, 'create'])->name('search.input');
    Route::get('/tweet/search/result', [SearchController::class, 'index'])->name('search.result');
    Route::get('/tweet/blocklist', [TweetController::class, 'blocklist'])->name('tweet.blocklist');
    Route::get('/tweet/timeline', [TweetController::class, 'timeline'])->name('tweet.timeline');
    Route::get('user/{user}', [FollowController::class, 'show'])->name('follow.show');
    Route::get('user/{user}/edit', [FollowController::class, 'edit'])->name('follow.edit');
    Route::put('user/{user}/update', [FollowController::class, 'update'])->name('follow.update');
    Route::post('user/{user}/follow', [FollowController::class, 'store'])->name('follow');
    Route::post('user/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');
    Route::post('user/{user}/block', [BlockController::class, 'store'])->name('block');
    Route::post('user/{user}/unblock', [BlockController::class, 'destroy'])->name('unblock');
    Route::get('/tweet/mypage', [TweetController::class, 'mydata'])->name('tweet.mypage');
    Route::post('tweet/{tweet}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('tweet/{tweet}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');
    Route::resource('tweet', TweetController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
