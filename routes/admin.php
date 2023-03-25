<?php

use App\Http\Controllers\Post\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\user\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web", "auth", "verified", and "role:admin" middleware
| groups. All of the routes and their names are prefixed with "admin".
| Make something great!
|
*/

Route::redirect('/', '/admin/dashboard', 301);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('posts/{post_id}/comments', [CommentController::class, 'index'])->name('comments.index');
Route::delete('posts/{post_id}/comments/{comment_id}', [CommentController::class, 'destroy'])->name('comments.destroy');

