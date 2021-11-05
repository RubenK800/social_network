<?php

use App\Http\Controllers\IndependentCommentsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersAvatarsController;
use App\Http\Controllers\UsersProfilesController;
use App\Http\Controllers\UsersWallsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('users', [UsersController::class, 'index']);
    Route::get('user-profile', [UsersProfilesController::class,'index'])->name('user.profile.index');
    Route::get('user-profile/{id}', [UsersAvatarsController::class,'show'])->name('user.profile.show');
    Route::post('upload-avatar',[UsersAvatarsController::class,'store'])->name('upload-avatar');
    Route::get('avatar/{userAvatar}',[UsersAvatarsController::class,'show'])->name('show-avatar');
    Route::get('user-wall',[UsersWallsController::class,'index'])->name('user-wall.index');
    Route::post('save-post',[PostsController::class,'store'])->name('save-post');
    Route::post('add-like',[LikesController::class,'store'])->name('add-like');
    Route::post('ind-comments',[IndependentCommentsController::class,'store'])->name('add-independent-comment');
});


