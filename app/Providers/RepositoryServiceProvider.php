<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\StarWarMovieRepository;
use App\Repositories\UserRepositoryEloquent;
use App\Repositories\StarWarMovieRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(StarWarMovieRepository::class, StarWarMovieRepositoryEloquent::class);
        //:end-bindings:
    }
}
