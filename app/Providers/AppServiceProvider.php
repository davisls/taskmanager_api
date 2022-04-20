<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\AuthInterface',
            'App\Services\AuthService'
        );
        $this->app->bind(
            'App\Interfaces\TaskInterface',
            'App\Services\TaskService'
        );
        $this->app->bind(
            'App\Interfaces\UserInterface',
            'App\Services\UserService'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
