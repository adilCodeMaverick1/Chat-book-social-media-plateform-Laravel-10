<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AboutController;
use App\Http\Controllers\NewsfeedController;
use App\Http\Controllers\UserController;

use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/newsfeed', [NewsfeedController::class, 'index'])->name('newsfeed');
    Route::post('/newsfeed/store', [NewsfeedController::class, 'store'])->name('newsfeed.store');
    Route::post('/newsfeed/like', [NewsfeedController::class, 'like'])->name('newsfeed.like');
    Route::post('/newsfeed/comment', [NewsfeedController::class, 'comment'])->name('newsfeed.comment');
    Route::delete('/newsfeed/delete/{post}', 'App\Http\Controllers\NewsfeedController@delete')->name('newsfeed.delete');
//profile
Route::get('/search', [UserController::class, 'search'])->name('search');
//visit profile
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.profile');
Route::post('/travel', 'NewsfeedController@travel')->name('travel');



});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/newsfeed', function () {
        return view('newsfeed.index');
    })->name('newsfeed');
});
?>