<?php

namespace App\Providers;

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
        $this->app->bind(
            'App\repositories\EloquentRepositoryInterface',
            'App\repositories\Eloquent\BasicRepository'
        );

        $this->app->bind(
            'App\repositories\GradesRepositoryInterface',
            'App\repositories\Eloquent\GradesRepository'
        );

        $this->app->bind(
            'App\repositories\ClassroomsRepositoryInterface',
            'App\repositories\Eloquent\ClassroomsRepository'
        );

        $this->app->bind(
            'App\repositories\SectionsRepositoryInterface',
            'App\repositories\Eloquent\SectionsRepository'
        );

        $this->app->bind(
            'App\repositories\TeachersRepositoryInterface',
            'App\repositories\Eloquent\TeachersRepository'
        );




    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
