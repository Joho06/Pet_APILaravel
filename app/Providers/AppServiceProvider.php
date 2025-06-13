<?php

namespace App\Providers;
use App\Services\MascotaService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\MascotaApiService::class, function ($app) {
            return new \App\Services\MascotaApiService();
        });

        $this->app->singleton(\App\Services\MascotaService::class, function ($app) {
            return new \App\Services\MascotaService($app->make(\App\Services\MascotaApiService::class));
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
