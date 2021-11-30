<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersAvatarsController;
use App\Http\Controllers\UsersProfilesController;
use App\Http\Controllers\UsersWallsController;
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


Route::group(['middleware' => ['auth']], function () {
    Route::get('users', [UsersController::class, 'index']);
    Route::get('user-profile', [UsersProfilesController::class, 'index'])->name('user.profile.index');
    Route::get('user-profile/{id}', [UsersAvatarsController::class, 'show'])->name('user.profile.show');
    Route::post('avatar', [UsersAvatarsController::class, 'store'])->name('avatar.store');
    Route::get('avatar/{userAvatar}', [UsersAvatarsController::class, 'show'])->name('show-avatar');
    Route::get('user-wall', [UsersWallsController::class, 'index'])->name('user-wall.index');
    Route::post('posts', [PostsController::class, 'store'])->name('posts.store');
    Route::delete('posts/{id}', [PostsController::class, 'destroy'])->name('posts.destroy');
    Route::put('posts/{id}', [PostsController::class, 'update'])->name('posts.update');
    Route::get('posts/{id}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::post('likes', [LikesController::class, 'store'])->name('likes.store');
    Route::post('comments', [CommentsController::class, 'store'])->name('comments.store');
    Route::delete('comments/{id}', [CommentsController::class, 'destroy'])->name('comments.destroy');
    Route::put('comments/{id}', [CommentsController::class, 'update'])->name('comments.update');
});

//Route::get('/{asdf}', function () {
//    return view('layouts.vue');//view('auth.login');
//});/*->where('asdf',  '.*');*/

Route::get('/', function () {
    return view('layouts.vue');//view('auth.login');
});
