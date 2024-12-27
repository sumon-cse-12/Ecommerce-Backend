<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SystemSettings\SystemSettingsInterface;
use App\Repositories\SystemSettings\SystemSettingsRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SystemSettingsInterface::class, SystemSettingsRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
