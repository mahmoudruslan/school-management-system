<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

//define('PAGINATION_COUNT',2);
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

//Auth::routes();// ->name('login')
// Route::group(['middleware' => 'guest'], function () { 
// Route::get('/', function () {
//     return view('auth.login'); 
// });


############################# Package MCamara ###########################################

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],


], function () {
    ############################# dashboard ################################################################
    //Route::get('/dashboard', 'HomeController@index')->name('dashboard');


    Route::group(['middleware' => 'guest'], function () {
        Route::get('login-show/{type}', 'Auth\LoginController@showForm')->name('login.show');

        Route::post('/login', 'Auth\LoginController@login')->name('login');

        Route::get('/', function () {
            return view('auth.selection');
        })->name('selection');
    });

    Route::get('logout/{type}', 'Auth\LoginController@logout')->name('logout');


    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {

        Route::get('dashboard', 'HomeController@admin');
        ############################# begin grades ###################################################################
        Route::resource('grades', 'GradeController')->middleware('can:grades');
        ############################# begin Classroom ##############################################################
        Route::resource('classrooms', 'ClassroomController')->middleware('can:classrooms');

        ############################# begin sections ###################################################################
        Route::group(['middleware' => 'can:sections'], function () {
            Route::resource('sections', 'SectionController');
            Route::get('classrooms/{id}', 'SectionController@getClassrooms');
        });
        ############################# begin Parents ###################################################################
        Route::resource('parents', 'TheParentController')->middleware('can:parents');;
        ############################# begin Teachers ###################################################################
        Route::resource('teachers', 'TeacherController')->middleware('can:teachers');;
        ############################# begin Students ###################################################################
        Route::group(['middleware' => 'can:students'], function () {
            Route::resource('students', 'StudentController');
            Route::get('section/{id}', 'StudentController@getSections');
        });


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
        Route::group(['middleware' => 'can:attendances'], function () {
            Route::resource('attendances', 'AttendanceController');
            Route::get('show-layout/{id}', 'AttendanceController@showLayout')->name('attendances.showLayout');
            Route::get('index/{id}', 'AttendanceController@indexx')->name('attendances.indexx');
        });

        ################################################## begin Subjects ##########################################
        Route::resource('subjects', 'SubjectController')->middleware('can:subjects');;
        ################################################## begin exams ###############################################
        Route::group(['middleware' => 'can:results'], function () {
            Route::resource('results', 'ResultController');
            Route::get('create/{teacher_id}', 'ResultController@create1')->name('results.create1');
            Route::get('create2', 'ResultController@create2')->name('results.create2');

            Route::get('index', 'ResultController@index1')->name('results.index1');
            Route::get('index2/{classroom_id}', 'ResultController@index2')->name('results.index2');
        });


        ################################################## begin Books ##########################################
        Route::group(['middleware' => 'can:books'], function () {
            Route::resource('books', 'BookController');
            Route::get('download/{id}', 'BookController@download')->name('books.download');
        });


        ################################################## begin settings ###############################################
        Route::resource('school_data', 'SchoolDataController')->middleware('can:school_data');;
        ############################# begin save and delete attachments ################################################
        Route::resource('roles', 'RoleController')->middleware('can:roles');;

        Route::group(['middleware' => ['throttle:10,1']], function () {

            //دي ميدل ويير نازلة مع لارفيل عشان لو حد عمل ريكوستات كتيير علي السيرفر ورا بعض يوقفه وقت معين ميعرفش يعمل ريكوستات     دقيقة مثلا اوي زي من 
        });




        Route::post('save-attachments/{id}', 'HomeController@saveAttachments')->name('save.attachments');
        Route::post('delete-attachments/{id}', 'HomeController@deleteAttachments')->name('delete.attachments');
        Route::get('empty', function () {
            return view('empty');
        });
    });
});
