<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\PostController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [DefaultController::class, 'index'])->name('index');
Route::get('/questions/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/questions/topics/{topic}', [PostController::class, 'postByTopic'])->name('posts.showByTopic');

// Route::get('posts/{id}', [PostController::class, 'show'])->name('post.show');
Route::get('questions/{id}/comment', [PostController::class, 'loadMoreComments'])->name('post.comments');
