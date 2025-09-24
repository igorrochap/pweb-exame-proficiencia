<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Contracts\Repositories\CategoryRepository::class, \App\Repositories\EloquentCategoryRepository::class);
        $this->app->bind(\App\Contracts\Repositories\UserRepository::class, \App\Repositories\EloquentUserRepository::class);
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
