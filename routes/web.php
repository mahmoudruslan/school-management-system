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

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    ############################# dashboard ################################################################
    //Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    

    Route::group(['middleware' => 'guest'], function () {
        Route::get('login-show/{type}', 'Auth\LoginController@showForm')->name('login.show');

        Route::post('/login','Auth\LoginController@login')->name('login');

        Route::get('/', function () {
            return view('auth.selection'); 
        })->name('selection');
    });
    
    Route::GET('logout/{type}','Auth\LoginController@logout')->name('logout');

    Route::get('teachers/dashboard', 'HomeController@teacher')->middleware('auth:teacher');
    Route::get('students/dashboard', 'HomeController@student')->middleware('auth:student');
    Route::get('parents/dashboard', 'HomeController@parent')->middleware('auth:parent');
    Route::get('admin/dashboard', 'HomeController@admin')->middleware('auth:web');

    ############################# begin grades ###################################################################
    Route::group(['namespace' => 'grades'], function () {
        Route::resource('grades', 'GradeController');
    });
    ############################# begin Classroom ##############################################################
    Route::group(['namespace' => 'Classrooms'], function () {
        Route::resource('Classrooms', 'ClassroomController');
    });

    ############################# begin sections ###################################################################
    Route::group(['namespace' => 'Sections'], function () {
        Route::resource('Sections', 'SectionController');
        Route::get('classrooms/{id}', 'SectionController@getClassrooms');
    });
    ############################# begin Parents ###################################################################
    Route::group(['namespace' => 'parents'], function () {
        Route::resource('Parents', 'TheParentsController');
    });
    ############################# begin Teachers ###################################################################
    Route::group(['namespace' => 'Teachers'], function () {
        Route::resource('Teachers', 'TeachersController');
    });
    ############################# begin Students ###################################################################
    Route::group(['namespace' => 'Students'], function () {
        Route::resource('Students', 'StudentsController');
        Route::get('section/{id}', 'StudentsController@getSections');

        ####################### begin Students Promotions ##################################
        Route::resource('Promotions', 'PromotionController');
        Route::post('destroy.all', 'PromotionController@deleteAll')->name('destroy.all');
        ####################### begin Students Graduated ##################################
        Route::resource('Graduated', 'GraduatedController');
        Route::get('return-students', 'GraduatedController@returnStudents')->name('return.students');
    });

    ################################################## begin Financial Accounting ##########################################
    ####################### begin Students fees #####################################
    Route::group(['namespace' => 'FinancialAccounting'], function () {
        Route::resource('Fees', 'FeeController');

        ####################### begin Students fees invoices ############################
        Route::resource('FeesInvoices', 'FeesInvoicesController');

        ####################### begin Students fees invoices ############################
        Route::resource('StudentReceipt', 'StudentReceiptController');

        ####################### begin Students fees invoices ############################
        Route::resource('FundAccounts', 'FundAccountsController');

        ####################### begin Fee processing ####################################
        Route::resource('FeeProcessing', 'FeeProcessingController');

        ####################### begin Payments ##########################################
        Route::resource('Payments', 'PaymentsController');
    });
    ################################################## begin Attendances ##########################################

    Route::group(['namespace' => 'Attendances'], function () {
        Route::resource('Attendances', 'AttendancesController');
        Route::get('show-layout/{id}', 'AttendancesController@showLayout')->name('Attendances.showLayout');
        Route::get('index/{id}', 'AttendancesController@indexx')->name('Attendances.indexx');
    });
    ################################################## begin Subjects ##########################################
    Route::resource('Subjects', 'Subjects\SubjectController');
    ################################################## begin exams ###############################################
    Route::resource('results', 'ResultsController');
    Route::get('create/{teacher_id}', 'ResultsController@create1')->name('results.create1');
    Route::get('create2', 'ResultsController@create2')->name('results.create2');

    Route::get('index', 'ResultsController@index1')->name('results.index1');
    Route::get('index2/{classroom_id}', 'ResultsController@index2')->name('results.index2');

    ################################################## begin Books ##########################################
    Route::resource('books', 'BooksController');
    Route::get('download/{id}', 'BooksController@download')->name('books.download');

    ################################################## begin settings ###############################################
    Route::resource('school_data', 'SchoolDataController');
    ############################# begin save and delete attachments ################################################

    Route::group([ 'middleware' => ['throttle:10,1']], function () {

        //دي ميدل ويير نازلة مع لارفيل عشان لو حد عمل ريكوستات كتيير علي السيرفر ورا بعض يوقفه وقت معين ميعرفش يعمل ريكوستات     دقيقة مثلا اوي زي من 
    });




    Route::post('save-attachments/{id}', 'HomeController@saveAttachments')->name('save.attachments');
    Route::post('delete-attachments/{id}', 'HomeController@deleteAttachments')->name('delete.attachments');
    Route::get('empty', function () {
        return view('empty');
    });
    Route::get('xx', 'HomeController@xx');
});
