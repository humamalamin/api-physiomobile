<?php

namespace App\Providers;

use App\Repository\ApiClientRepository;
use App\Repository\interface\ApiClientInterface;
use App\Repository\interface\UserInterface;
use App\Repository\UserRepository;
use App\Services\ApiClientService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ApiClientInterface::class, ApiClientRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
