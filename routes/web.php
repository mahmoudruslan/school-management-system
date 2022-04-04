<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Livewire\Calendar;


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
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],


], function () {
    ############################# dashboard ################################################################



    Route::group(['middleware' => 'guest'], function () {
        Route::get('login-show/{type}', 'Auth\LoginController@showForm')->name('login.show');

        Route::post('/login', 'Auth\LoginController@login')->name('login');

        Route::get('/', function () {
            return view('auth.selection');
        })->name('selection');
    });

    Route::get('logout/{type}', 'Auth\LoginController@logout')->name('logout');

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
        Route::get('dashboard', 'HomeController@admin')->name('dashboard');
        ############################# begin grades ###################################################################
        Route::resource('grades', 'GradeController')->middleware('can:grades');
        ############################# begin Classroom ##############################################################
        Route::resource('classrooms', 'ClassroomController')->middleware('can:classrooms');
        ############################# begin sections ###################################################################
        Route::resource('sections', 'SectionController')->middleware('can:sections');
        ############################# begin Parents ###################################################################
        Route::resource('parents', 'TheParentController')->middleware('can:parents');
        ############################# begin Teachers ###################################################################
        Route::resource('teachers', 'TeacherController')->middleware('can:teachers');
        ############################# begin Students ###################################################################
        Route::resource('students', 'StudentController')->middleware('can:students');
        ####################### begin Students Promotions ##################################
        Route::group(['middleware' => 'can:promotions'], function () {
            Route::resource('promotions', 'PromotionController');
            Route::post('destroy.all', 'PromotionController@deleteAll')->name('destroy.all');
        });
        ####################### begin Students Graduated ##################################
        Route::group(['middleware' => 'can:graduated'], function () {
            Route::resource('graduated', 'GraduatedController');
            Route::get('return-students', 'GraduatedController@returnStudents')->name('return.students');
        });
        ################################################## begin Financial Accounting ##########################################
        Route::group(['middleware' => 'can:accounting'], function () {
            ####################### begin Students fees #####################################
            Route::resource('fees', 'FeeController');

            ####################### begin Students fees invoices ############################
            Route::resource('feesInvoices', 'FeesInvoiceController');

            ####################### begin Students fees invoices ############################
            Route::resource('studentReceipt', 'StudentReceiptController');

            ####################### begin Students fees invoices ############################
            Route::resource('fundAccounts', 'FundAccountsController');

            ####################### begin Fee processing ####################################
            Route::resource('feeProcessing', 'FeeProcessingController');

            ####################### begin Payments ##########################################
            Route::resource('payments', 'PaymentController');
        });

        ################################################## begin Attendances ##########################################
        Route::resource('attendances', 'AttendanceController')->middleware('can:attendances');

        ################################################## begin Subjects ##########################################
        Route::resource('subjects', 'SubjectController')->middleware('can:subjects');
        ################################################## begin exams ###############################################
        Route::group(['middleware' => 'can:results'], function () {
            Route::resource('results', 'ResultController');
            Route::get('create2', 'ResultController@create2')->name('results.create2');
            Route::get('index2/{classroom_id}', 'ResultController@index2')->name('results.index2');
        });

        ################################################## begin Books ##########################################
        Route::group(['middleware' => 'can:books'], function () {
            Route::resource('books', 'BookController');
            Route::get('download/{id}', 'BookController@download')->name('books.download');
        });

        ################################################## begin Books ##########################################
        Route::resource('exams_timetables', 'ExamsTimetableController')->middleware('can:exams_timetables');
        ################################################## begin roles ###############################################
        Route::resource('roles', 'RoleController')->middleware('can:roles');

        ################################################## begin school_data ###############################################

        Route::resource('school_data', 'SchoolDataController')->middleware('can:school_data');

        ############################# services ############################################################################
        Route::post('save-attachments/{id}', 'ServicesController@saveAttachments')->name('save.attachments');
        Route::post('delete-attachments/{id}', 'ServicesController@deleteAttachments')->name('delete.attachments');
        Route::get('get_classes/{id}', 'ServicesController@getClassrooms');
        Route::get('get_sections/{id}', 'ServicesController@getSections');


        Route::group(['middleware' => ['throttle:10,1']], function () {

            //دي ميدل ويير نازلة مع لارفيل عشان لو حد عمل ريكوستات كتيير علي السيرفر ورا بعض يوقفه وقت معين ميعرفش يعمل ريكوستات     دقيقة مثلا اوي زي من 
        });

        Livewire::component('calendar', Calendar::class);;
    });
});
