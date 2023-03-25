<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');



Route::group(['middleware' => ['auth', 'verified', 'role:admin'], 'prefix'=>'admin', 'as'=>'admin.'], function () {

    Route::redirect('/', '/admin/dashboard', 301);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('posts/{post_id}/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::delete('posts/{post_id}/comments/{comment_id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('posts', [PostController::class, 'store']);
    Route::post('comments', [CommentController::class, 'store']);
    Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('posts/{id}/react', [PostController::class, 'react'])->name('posts.react');
    Route::delete('posts/{id}/react', [PostController::class, 'unreact'])->name('posts.unreact');
    Route::post('posts/{id}/stat', [PostController::class, 'stat'])->name('posts.stat');
    Route::post('comments/{id}/react', [CommentController::class, 'react'])->name('comments.react');
    Route::delete('comments/{id}/react', [CommentController::class, 'unreact'])->name('comments.unreact');
});

Route::middleware('auth')->group(function () {
    Route::get('persons/pending', [PersonController::class, 'pending'])->name('persons.pending');
    Route::delete('persons/{id}/cancel', [PersonController::class, 'cancel'])->name('persons.cancel');
    Route::post('persons/{id}/addfriend', [PersonController::class, 'addfriend'])->name('persons.addfriend');
    Route::get('persons', [PersonController::class, 'index'])->name('persons.index');
    
    Route::get('friends/pending-requests', [FriendController::class, 'pendingRequests'])->name('friends.pending-requests');
    Route::delete('friends/{id}/unfriend', [FriendController::class, 'unfriend'])->name('friends.unfriend');
    Route::post('friends/{id}/acceptfriend', [FriendController::class, 'acceptFriend'])->name('friends.acceptfriend');
    Route::get('friends', [FriendController::class, 'index'])->name('friends.index');
});
