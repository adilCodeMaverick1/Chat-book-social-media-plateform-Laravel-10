<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AboutController;
use App\Http\Controllers\VirtualCurrencyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsfeedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResumeController;

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
    //virtual creency
    Route::get('/virtual-currency', [VirtualCurrencyController::class, 'index'])->name('virtual-currency');
Route::post('/purchase-verification-mark', [VirtualCurrencyController::class, 'purchaseVerificationMark'])->name('purchase-verification-mark');

   
    Route::post('/newsfeed/store', [NewsfeedController::class, 'store'])->name('newsfeed.store');
    Route::post('/newsfeed/like', [NewsfeedController::class, 'like'])->name('newsfeed.like');
    Route::post('/newsfeed/comment', [NewsfeedController::class, 'comment'])->name('newsfeed.comment');
    Route::delete('/newsfeed/delete/{post}', 'App\Http\Controllers\NewsfeedController@delete')->name('newsfeed.delete');
//profile
Route::get('/search', [UserController::class, 'search'])->name('search');
//visit profile
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.profile');
Route::post('/travel', 'NewsfeedController@travel')->name('travel');
//follow
Route::post('/follow', [UserController::class, 'follow'])->middleware('auth');
//unfollow
Route::delete('/follow', [UserController::class, 'unfollow'])->middleware('auth');

//user image upload route
Route::post('/update-profile', [ProfileController::class, 'updateProfile']);

Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
//brodcasting route fron user model
Route::get('/unreadcount',function(){
    $count = auth()->user()->getMessageCount();
    return response()->json(['count' => $count]);
})->name('unreadcount');

Route::get('/social-links/create', [UserController::class, 'create'])->name('social-links.create');
Route::post('/social-links', [UserController::class, 'linkStore'])->name('social-links.store');
Route::get('/social-links/{id}', [UserController::class, 'linkId'])->name('social-links.edit')->middleware('check.social.link.owner');
Route::put('/social-links/{id}', [UserController::class, 'update'])->name('social-links.update');

Route::get('/resume/create', [ResumeController::class, 'create'])->name('resume.create');
Route::post('/resume', [ResumeController::class, 'store'])->name('resume.store');
Route::get('/resume/{user}/edit', [ResumeController::class, 'edit'])->name('resume.edit')->middleware('check.user.owner');
Route::put('/resume/{user}', [ResumeController::class, 'update'])->name('resume.update');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/newsfeed', [NewsfeedController::class, 'index'])->name('newsfeed');
});

?>