<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReactController;
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

