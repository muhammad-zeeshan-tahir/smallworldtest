<?php

namespace App\Providers;

use App\Interfaces\Authorization\UserAuthorizationServiceInterface;
use App\Services\Authorization\UserAuthorizationService;
use App\Interfaces\StarWarMovie\StarWarMovieServiceInterface;
use App\Services\StarWarMovie\StarWarMovieService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserAuthorizationServiceInterface::class, UserAuthorizationService::class);
        $this->app->bind(StarWarMovieServiceInterface::class, StarWarMovieService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): array
    {
        return [
            UserAuthorizationServiceInterface::class,
            StarWarMovieServiceInterface::class,
        ];
    }
}
