<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\GraduatedController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\TheParentController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\SchoolDataController;
use App\Http\Controllers\Admin\FeesInvoiceController;
use App\Http\Controllers\Admin\FeeProcessingController;
use App\Http\Controllers\Admin\StudentReceiptController;
use App\Http\Controllers\Admin\SubjectController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

############################# Package MCamara ###########################################
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']

], function () {
    ############################# dashboard ################################################################

    Route::group(['middleware' => 'guest'], function () {
        Route::get('login-show/{type}', [LoginController::class, 'showForm'])->name('login.show');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::view('/', 'auth.selection')->name('selection');
    });
    Route::get('logout/{type}', [LoginController::class, 'logout'])->name('logout');
    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
        Route::get('dashboard', [HomeController::class, 'admin'])->name('dashboard');
        Route::resource('grades', GradeController::class)->middleware('can:grades');
        Route::resource('classrooms', ClassroomController::class)->middleware('can:classrooms');
        Route::resource('sections', SectionController::class)->middleware('can:sections');
        Route::resource('parents', TheParentController::class)->middleware('can:parents');
        Route::resource('admins', AdminController::class)->middleware('can:teachers');
        Route::resource('students', StudentController::class)->middleware('can:students');
        Route::group(['middleware' => 'can:promotions'], function () {
            Route::resource('promotions',    PromotionController::class);
            Route::post('destroy.all', [PromotionController::class, 'deleteAll'])->name('destroy.all');
        });
                        ########## begin Students Graduated #################
        Route::group(['middleware' => 'can:graduated'], function () {
            Route::resource('graduated', GraduatedController::class);
            Route::get('return-students', [App\Http\Controllers\Admin\GraduatedController::class, 'returnStudents'])->name('return.students');
        });
        ################################################## begin Financial Accounting ##########################################
        Route::group(['middleware' => 'can:accounting'], function () {
            Route::resource('fees', FeeController::class);
            Route::resource('feesInvoices', FeesInvoiceController::class);
            Route::resource('studentReceipt', StudentReceiptController::class);
            Route::resource('feeProcessing', FeeProcessingController::class);
            Route::resource('payments', PaymentController::class);
        });
        Route::resource('attendances', AttendanceController::class)->middleware('can:attendances');
        Route::resource('subjects', SubjectController::class)->middleware('can:subjects');
        Route::group(['middleware' => 'can:results'], function () {
            Route::get('results/grades-classrooms-filter', [ResultController::class, 'gradesClassroomsFilter'])->name('results.grades.classrooms.filter');
            Route::get('results/subject-time-filter', [ResultController::class, 'subjectTimeFilter'])->name('results.subject.time.filter');
            Route::post('results/giving-degrees', [ResultController::class, 'givingDegrees'])->name('results.giving.degrees');
            Route::get('results/grade-classroom-students/{classroom_id}', [ResultController::class, 'gradeAndClassroomStudents'])->name('results.grade.classroom.students');
            Route::resource('results', ResultController::class);
        });
        Route::group(['middleware' => 'can:books'], function () {
            Route::resource('books', BookController::class);
            Route::get('download/{id}', [BookController::class, 'download'])->name('admin.books.download');
        });
        Route::resource('roles', RoleController::class)->middleware('can:roles');

        Route::resource('school_data', SchoolDataController::class)->middleware('can:school_data');
        ################# services #########################################
        Route::controller(ServicesController::class)->group(function() {
            Route::post('save-attachments/{id}', 'saveAttachments')->name('save.attachments');
            Route::post('delete-attachments/{id}', 'deleteAttachments')->name('delete.attachments');
            Route::get('get_classes/{id}', 'getClassrooms');
            Route::get('get_sections/{id}', 'getSections');
        });

        // Route::group(['middleware' => ['throttle:10,1']], function () {
        // });
    });
});
