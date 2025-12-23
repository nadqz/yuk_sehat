<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        // Gunakan URL::forceRootUrl agar semua link form mengarah ke domain https kamu
        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
            \URL::forceRootUrl(config('app.url'));
        }
    }
}
