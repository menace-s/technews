<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('back.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/category',CategoryController::class);
Route::resource('/article', ArticleController::class);
Route::resource('/author',UserController::class);
require __DIR__.'/auth.php';
