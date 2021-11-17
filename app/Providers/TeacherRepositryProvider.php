<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TeacherRepositryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\interfaces\Repositoryinterface',
            'App\repositories\Repositry'
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
