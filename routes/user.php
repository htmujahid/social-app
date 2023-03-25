<?php

use App\Http\Controllers\Post\CommentController;
use App\Http\Controllers\User\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\PersonController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web", "auth", "verified", and "role:user" middleware
| groups. Make something great!
|
*/

// home page
Route::get('/', [HomeController::class, 'index'])->name('home');
// profile page
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// posts and comments handling
Route::post('posts', [PostController::class, 'store'])->name('posts.store');
Route::get('{id}/posts', [PostController::class, 'userPosts'])->name('user.posts');
Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::post('posts/{id}/react', [PostController::class, 'react'])->name('posts.react');
Route::delete('posts/{id}/react', [PostController::class, 'unreact'])->name('posts.unreact');
Route::post('posts/{id}/stat', [PostController::class, 'stat'])->name('posts.stat');
Route::post('comments/{id}/react', [CommentController::class, 'react'])->name('comments.react');
Route::delete('comments/{id}/react', [CommentController::class, 'unreact'])->name('comments.unreact');
// persons connections handling
Route::get('persons/pending', [PersonController::class, 'pending'])->name('persons.pending');
Route::delete('persons/{id}/cancel', [PersonController::class, 'cancel'])->name('persons.cancel');
Route::post('persons/{id}/addfriend', [PersonController::class, 'addfriend'])->name('persons.addfriend');
Route::get('persons', [PersonController::class, 'index'])->name('persons.index');
// friends connections handling
Route::get('friends/pending-requests', [FriendController::class, 'pendingRequests'])->name('friends.pending-requests');
Route::delete('friends/{id}/unfriend', [FriendController::class, 'unfriend'])->name('friends.unfriend');
Route::post('friends/{id}/acceptfriend', [FriendController::class, 'acceptFriend'])->name('friends.acceptfriend');
Route::get('friends', [FriendController::class, 'index'])->name('friends.index');