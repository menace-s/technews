<?php

use App\Http\Controllers\testController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontCategoryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DetailController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES
|--------------------------------------------------------------------------
*/

Route::get('/', [testController::class, 'index'])->name('home');
Route::get('/article/{slug}', [DetailController::class, 'show'])->name('article.detail');
Route::get('/categorie/{slug}', [FrontCategoryController::class, 'index'])->name('category.article');


Route::middleware('auth')->group(function () {
    
    // Profil
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified','CheckRole:admin,author')
        ->name('dashboard');
    
    // Gestion articles (Admin + Author)
    Route::middleware('CheckRole:admin,author')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('article', ArticleController::class);
        });
});

/*
|--------------------------------------------------------------------------
| ROUTES ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('category', CategoryController::class);
        Route::resource('author', UserController::class);
        Route::resource('social-media', SocialMediaController::class);
        
        Route::controller(SettingsController::class)->group(function () {
            Route::get('settings', 'index')->name('settings.index');
            Route::put('settings', 'update')->name('settings.update');
        });
    });

/*
|--------------------------------------------------------------------------
| ROUTES D'AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
