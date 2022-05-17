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
            'App\repositories\GradeRepositoryInterface',
            'App\repositories\Eloquent\GradeRepository'
        );

        $this->app->bind(
            'App\repositories\ClassroomRepositoryInterface',
            'App\repositories\Eloquent\ClassroomRepository'
        );

        $this->app->bind(
            'App\repositories\SectionRepositoryInterface',
            'App\repositories\Eloquent\SectionRepository'
        );

        $this->app->bind(
            'App\repositories\AdminRepositoryInterface',
            'App\repositories\Eloquent\AdminRepository'
        );

        $this->app->bind(
            'App\repositories\StudentRepositoryInterface',
            'App\repositories\Eloquent\StudentRepository'
        );

        $this->app->bind(
            'App\repositories\PromotionRepositoryInterface',
            'App\repositories\Eloquent\PromotionRepository'
        );

        $this->app->bind(
            'App\repositories\GraduatedRepositoryInterface',
            'App\repositories\Eloquent\GraduatedRepository'
        );

        $this->app->bind(
            'App\repositories\FeeRepositoryInterface',
            'App\repositories\Eloquent\FeeRepository'
        );

        $this->app->bind(
            'App\repositories\FeesInvoiceRepositoryInterface',
            'App\repositories\Eloquent\FeesInvoiceRepository'
        );

        $this->app->bind(
            'App\repositories\StudentReceiptRepositoryInterface',
            'App\repositories\Eloquent\StudentReceiptRepository'
        );

        $this->app->bind(
            'App\repositories\FundAccountRepositoryInterface',
            'App\repositories\Eloquent\FundAccountRepository'
        );

        $this->app->bind(
            'App\repositories\FeeProcessingRepositoryInterface',
            'App\repositories\Eloquent\FeeProcessingRepository'
        );

        $this->app->bind(
            'App\repositories\PaymentRepositoryInterface',
            'App\repositories\Eloquent\PaymentRepository'
        );

        $this->app->bind(
            'App\repositories\StudentAccountRepositoryInterface',
            'App\repositories\Eloquent\StudentAccountRepository'
        );

        $this->app->bind(
            'App\repositories\AttendanceRepositoryInterface',
            'App\repositories\Eloquent\AttendanceRepository'
        );

        $this->app->bind(
            'App\repositories\SubjectRepositoryInterface',
            'App\repositories\Eloquent\SubjectRepository'
        );

        $this->app->bind(
            'App\repositories\ResultRepositoryInterface',
            'App\repositories\Eloquent\ResultRepository'
        );

        $this->app->bind(
            'App\repositories\RoleRepositoryInterface',
            'App\repositories\Eloquent\RoleRepository'
        );

        $this->app->bind(
            'App\repositories\BookRepositoryInterface',
            'App\repositories\Eloquent\BookRepository'
        );

        $this->app->bind(
            'App\repositories\ExamsTimetableRepositoryInterface',
            'App\repositories\Eloquent\ExamsTimetableRepository'
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
