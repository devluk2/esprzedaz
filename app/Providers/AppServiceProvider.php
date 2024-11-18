<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PetApiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(PetApiService::class, function ($app) {
            return new PetApiService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
