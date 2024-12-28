<?php

namespace App\Providers;

use App\Filament\Exports\UserExporter;
use App\Models\User;
use App\Observers\UserObserver;
use App\Policies\UserPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


use Illuminate\Support\Facades\Blade;

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
        Gate::policy(User::class, UserPolicy::class);
        User::observe(UserObserver::class);

        Gate::before(function ($user, $ability) {
            return $user->hasRole('Admin') ? true : null;
        });

    }
}
