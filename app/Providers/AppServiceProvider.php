<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
            // On suppose que les rôles sont stockés comme "admin,author"
        $userRoles = explode(',', $user->role); // Transforme la chaîne en tableau : ['admin', 'author']

        return in_array('admin', $userRoles); // Vérifie si 'admin' est dans le tableau
        });
    }
}
