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

//define('PAGINATION_COUNT',20);
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

    

    Route::group([ 'middleware' => 'guest',], function () {
        Route::get('login-show/{type}', [LoginController::class, 'showForm'])->name('login.show');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::get('/', function () {
            return view('auth.selection');
        })->name('selection');
    });

    Route::get('logout/{type}',             [LoginController::class, 'logout'])->name('logout');

    Route::group([
        // 'namespace' => 'Admin', 
        'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
        Route::get('dashboard',             [HomeController::class, 'admin'])->name('dashboard');

                            ############## begin grades ###############
        Route::resource('grades',           GradeController::class)->middleware('can:grades');
        
                            ############# begin Classroom ##############
        Route::resource('classrooms',       ClassroomController::class)->middleware('can:classrooms');

    #                       ################# begin sections ##################
        Route::resource('sections',         SectionController::class)->middleware('can:sections');

    #                       ################# begin Parents ###################
        Route::resource('parents',          TheParentController::class)->middleware('can:parents');

    #                       ################# begin Teachers #################
        Route::resource('admins',         AdminController::class)->middleware('can:teachers');

    #                       ################# begin Students #################
        Route::resource('students',         StudentController::class)->middleware('can:students');
        
    #                       ########### begin Students Promotions #############
        Route::group(['middleware' => 'can:promotions'], function () {
            Route::resource('promotions',    PromotionController::class);
            Route::post('destroy.all',      [PromotionController::class, 'deleteAll'])->name('destroy.all');
        });
    ##                      ########## begin Students Graduated #################
        Route::group(['middleware' => 'can:graduated'], function () {
            Route::resource('graduated',    GraduatedController::class);
            Route::get('return-students',   [App\Http\Controllers\Admin\GraduatedController::class, 'returnStudents'])->name('return.students');
        });
        ################################################## begin Financial Accounting ##########################################
        Route::group(['middleware' => 'can:accounting'], function () {
                    ############### begin Students fees #############################
            Route::resource('fees',         FeeController::class);

                        ######### begin Students fees invoices #####################
            Route::resource('feesInvoices', FeesInvoiceController::class);

                        ############# begin Students fees invoices ###################
            Route::resource('studentReceipt', StudentReceiptController::class);

                        ############# begin Students fees invoices ######################
            // Route::resource('fundAccounts',     FundAccountsController::class);

                        ############ begin Fee processing ##############################
            Route::resource('feeProcessing',    FeeProcessingController::class);

                        ############ begin Payments #####################################
            Route::resource('payments',         PaymentController::class);
        });

#                       ##################### begin Attendances ################
        Route::resource('attendances',          AttendanceController::class)->middleware('can:attendances');

        ################################################## begin Subjects ###################
        Route::resource('subjects',             SubjectController::class)->middleware('can:subjects');
        
    #                       ###################################### begin exams #######################
        Route::group(['middleware' => 'can:results'], function () {
            Route::get('results/grades-classrooms-filter', [ResultController::class, 'gradesClassroomsFilter'])->name('results.grades.classrooms.filter');
            Route::get('results/subject-time-filter', [ResultController::class, 'subjectTimeFilter'])->name('results.subject.time.filter');
            Route::post('results/giving-degrees', [ResultController::class, 'givingDegrees'])->name('results.giving.degrees');
            Route::get('results/choose-subject-time/{classroom_id}', [ResultController::class, 'chooseSubjectAndTime'])->name('results.choose.subject.time');
            Route::resource('results',          ResultController::class);
        });

#                           ############################## begin Books #######################
        Route::group(['middleware' => 'can:books'], function () {
            Route::resource('books',            BookController::class);
            Route::get('download/{id}',         [BookController::class, 'download'])->name('admin.books.download');
        });

// #                           ####################### begin Books ########################
//         Route::resource('exams_timetables',     ExamsTimetableController::class)->middleware('can:exams_timetables');
    #                       ###################################### begin roles #############
        Route::resource('roles',                RoleController::class)->middleware('can:roles');

    #                       ###################################### begin school_data #############

        Route::resource('school_data',          SchoolDataController::class)->middleware('can:school_data');

    #                       ################# services #########################################
        Route::post('save-attachments/{id}',    [ServicesController::class, 'saveAttachments'])->name('save.attachments');
        Route::post('delete-attachments/{id}',  [ServicesController::class, 'deleteAttachments'])->name('delete.attachments');
        Route::get('get_classes/{id}',          [ServicesController::class, 'getClassrooms']);
        Route::get('get_sections/{id}',         [ServicesController::class, 'getSections']);


        Route::group(['middleware' => ['throttle:10,1']], function () {

        });

    });
});
