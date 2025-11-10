<?php

namespace App\Providers;

use App\Repositories\Interface\ContactRepositoryInterface;
use App\Repositories\Repository\ContactRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
    }
}
