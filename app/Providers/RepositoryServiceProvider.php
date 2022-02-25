<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use App\repositories\Eloquent\BooksRepository;
// use App\repositories\BooksRepositoryInterface;

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

        $this->app->bind(
            'App\repositories\StudentsRepositoryInterface',
            'App\repositories\Eloquent\StudentsRepository'
        );

        $this->app->bind(
            'App\repositories\PromotionsRepositoryInterface',
            'App\repositories\Eloquent\PromotionsRepository'
        );

        $this->app->bind(
            'App\repositories\GraduatedRepositoryInterface',
            'App\repositories\Eloquent\GraduatedRepository'
        );

        $this->app->bind(
            'App\repositories\FeesRepositoryInterface',
            'App\repositories\Eloquent\FeesRepository'
        );

        $this->app->bind(
            'App\repositories\FeesInvoicesRepositoryInterface',
            'App\repositories\Eloquent\FeesInvoicesRepository'
        );

        $this->app->bind(
            'App\repositories\StudentReceiptRepositoryInterface',
            'App\repositories\Eloquent\StudentReceiptRepository'
        );

        $this->app->bind(
            'App\repositories\FundAccountsRepositoryInterface',
            'App\repositories\Eloquent\FundAccountsRepository'
        );

        $this->app->bind(
            'App\repositories\FeeProcessingRepositoryInterface',
            'App\repositories\Eloquent\FeeProcessingRepository'
        );

        $this->app->bind(
            'App\repositories\PaymentsRepositoryInterface',
            'App\repositories\Eloquent\PaymentsRepository'
        );

        $this->app->bind(
            'App\repositories\StudentAccountsRepositoryInterface',
            'App\repositories\Eloquent\StudentAccountsRepository'
        );

        $this->app->bind(
            'App\repositories\AttendancesRepositoryInterface',
            'App\repositories\Eloquent\AttendancesRepository'
        );

        $this->app->bind(
            'App\repositories\SubjectsRepositoryInterface',
            'App\repositories\Eloquent\SubjectsRepository'
        );

        $this->app->bind(
            'App\repositories\ResultsRepositoryInterface',
            'App\repositories\Eloquent\ResultsRepository'
        );

        $this->app->bind(
            'App\repositories\BooksRepositoryInterface',
            'App\repositories\Eloquent\BooksRepository'
        );

        // $this->app->bind(
        //     BooksRepositoryInterface::class,
        //     BooksRepository::class
        // );


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
