<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Models\Settings;
use App\Models\Category;
use App\Models\SocialMedia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->hasRole('admin');
        });

        $settings = Settings::first();
        $socialMedias = SocialMedia::orderBy('id','DESC')->get();
        $categories = Category::where('isActive',1)->get();
        view()->share('socialMedias', $socialMedias);
        view()->share('settings', $settings);
        view()->share('categories', $categories);
    }
}
