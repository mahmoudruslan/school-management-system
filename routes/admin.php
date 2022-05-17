<?php
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ServicesController;




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

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
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
        Route::resource('teachers',         TeacherController::class)->middleware('can:teachers');

    #                       ################# begin Students #################
        Route::resource('students',         StudentController::class)->middleware('can:students');
        
    #                       ########### begin Students Promotions #############
        Route::group(['middleware' => 'can:promotions'], function () {
            Route::resource('promotions',    PromotionController::class);
            Route::post('destroy.all',      [App\Http\Controllers\Admin\PromotionController::class, 'deleteAll'])->name('destroy.all');
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
            Route::resource('fundAccounts',     FundAccountsController::class);

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
            Route::resource('results',          ResultController::class);
            Route::get('create2',               [App\Http\Controllers\Admin\ResultController::class, 'create2'])->name('results.create2');
            Route::get('index2/{classroom_id}', [App\Http\Controllers\Admin\ResultController::class, 'index2'])->name('results.index2');
        });

#                           ############################## begin Books #######################
        Route::group(['middleware' => 'can:books'], function () {
            Route::resource('books',            BookController::class);
            Route::get('download/{id}',         [App\Http\Controllers\Admin\BookController::class, 'download'])->name('admin.books.download');
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
