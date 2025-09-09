<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use App\Models\DataBarang; // Sesuaikan nama model
use App\Observers\BarangObserver;
use App\Rules\PasswordRules;

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
        Password::defaults(function () {
            $rule = Password::min(4);
            return $rule;
        });
    }
}
