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
Auth::routes();
Route::group(['middleware' => 'guest'],function(){//عشان اللي عامل لوج ان لو جه يدخل علي اللوجن تاني يدخله علي الداش بورد علي طول
    Route::get('/', function () {
        return view('auth.login');//يعني محدش هيعرف يدخل علي الراوت دا غير اللي مش عامل لوجن
    });
});

    ############################# Package MCamara ###########################################

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']],function(){
    ############################# dashboard ################################################################
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');


    ############################# begin grades ###################################################################
    Route::group(['namespace' => 'grades'],function(){
        Route::resource('grades', 'GradeController');

    });
    ############################# begin Classroom ##############################################################
    Route::group(['namespace' => 'Classrooms'],function(){
        Route::resource('Classrooms', 'ClassroomController');
    });

    ############################# begin sections ###################################################################
    Route::group(['namespace' => 'Sections'],function(){
        Route::resource('Sections', 'SectionController');
        Route::get('classrooms/{id}','SectionController@getClassrooms');
    });
    ############################# begin Parents ###################################################################
    Route::group(['namespace' => 'parents'],function(){
        Route::resource('Parents', 'TheParentsController');

    });
    ############################# begin Teachers ###################################################################
    Route::group(['namespace' => 'Teachers'],function(){
        Route::resource('Teachers', 'TeachersController');
    });
    ############################# begin Students ###################################################################
    Route::group(['namespace' => 'Students'],function(){
        Route::resource('Students', 'StudentsController');
        Route::get('section/{id}','StudentsController@getSections');

    ####################### begin Students Promotions ##################################
        Route::resource('Promotions', 'PromotionController');
        Route::post('destroy.all','PromotionController@deleteAll')->name('destroy.all');
    ####################### begin Students Graduated ##################################
        Route::resource('Graduated', 'GraduatedController');
        Route::get('return-students','GraduatedController@returnStudents')->name('return.students');
    });


    ####################### begin Students fees ###################################################################
        Route::group(['namespace' => 'Fees'],function(){
            Route::resource('Fees', 'FeeController');

        });

    ####################### begin Students fees invoices ############################################################
    Route::group(['namespace' => 'FeesInvoices'],function(){
        Route::resource('FeesInvoices', 'FeesInvoicesController');

    });
    ####################### begin Students fees invoices ############################################################
    Route::group(['namespace' => 'StudentReceipt'],function(){
        Route::resource('StudentReceipt', 'StudentReceiptController');

    });
    ####################### begin Students fees invoices ############################################################
    Route::group(['namespace' => 'FundAccounts'],function(){
        Route::resource('FundAccounts', 'FundAccountsController');

    });
    ####################### begin Fee processing ############################################################
    Route::group(['namespace' => 'FeeProcessing'],function(){
        Route::resource('FeeProcessing', 'FeeProcessingController');

    });
    ####################### begin Payments ############################################################
    Route::group(['namespace' => 'Payments'],function(){
        Route::resource('Payments', 'PaymentsController');

    });


    ############################# begin save and delete attachments ################################################
    Route::post('save-attachments/{id}','HomeController@saveAttachments')->name('save.attachments');
    Route::post('delete-attachments/{id}','HomeController@deleteAttachments')->name('delete.attachments');
    Route::get('empty',function (){
        return view('empty');
    });
});

