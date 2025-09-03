<?php

use App\Http\Controllers\testController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [testController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified','CheckRole:admin,author'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/category',CategoryController::class)->middleware('admin');
Route::resource('/article', ArticleController::class);
Route::resource('/author',UserController::class)->middleware('admin');
Route::resource('/social-media',SocialMediaController::class)->middleware('admin');
Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index')->middleware('admin');
Route::put('/settings', [\App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update')->middleware('admin');
require __DIR__.'/auth.php';
