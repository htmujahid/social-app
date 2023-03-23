<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('comments', CommentController::class);
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
