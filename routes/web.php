<?php

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

Route::get('/', function () {
    return view('front');
});

Route::middleware('auth')->group(function () {

    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\PageController::class, 'home'])->name('dashboard');

        Route::resource('/users', \App\Http\Controllers\UserController::class)
            ->only(['index', 'destroy'])->middleware('role:admin');
        Route::resource('/tags', \App\Http\Controllers\TagController::class)->middleware('role:admin');
        Route::resource('/posts', \App\Http\Controllers\PostController::class)
            ->only(['store', 'update', 'destroy', 'edit', 'show']);

        Route::post('/posts/comments', [\App\Http\Controllers\CommentController::class, 'store'])
            ->name('comments.store');
        Route::delete('/posts/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])
            ->name('comments.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
