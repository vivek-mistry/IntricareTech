<?php

namespace App\Providers;

use App\Facades\Services\FileUploadService;
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
    public function boot(): void
    {
        $this->app->singleton("fileuploadservice", function ($app) {
            return app(FileUploadService::class);
        });
    }
}
