<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

define('PAGINATION_COUNT',2);
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
    ############################# dashboard ###########################################
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');


    ############################# begin grades ##############################################
    Route::group(['namespace' => 'grades'],function(){
        Route::resource('grades', 'GradeController');

    });
    ############################# begin Classroom #########################################
    Route::group(['namespace' => 'Classrooms'],function(){
        Route::resource('Classrooms', 'ClassroomController');
    });

    ############################# begin sections ##############################################
    Route::group(['namespace' => 'Sections'],function(){
        Route::resource('Sections', 'SectionController');
        Route::get('classrooms/{id}','SectionController@getClassrooms');
    });
    ############################# begin Parents ##############################################
    Route::group(['namespace' => 'parents'],function(){
        Route::resource('Parents', 'TheParentsController');

    });
    ############################# begin Teachers ##############################################
    Route::group(['namespace' => 'Teachers'],function(){
        Route::resource('Teachers', 'TeachersController');
    });
    ############################# begin Teachers ##############################################
    Route::group(['namespace' => 'Students'],function(){
        Route::resource('Students', 'StudentsController');
        Route::get('section/{id}','StudentsController@getSections');
    });

    ############################# begin save and delete attachments ##############################################
    Route::post('save-attachments/{id}','HomeController@saveAttachments')->name('save.attachments');
    Route::post('delete-attachments/{id}','HomeController@deleteAttachments')->name('delete.attachments');











        Route::post('Promotion-index', 'GradeController@Promotion-index')->name('Promotion.index');//دا عشان الايرور بس
        Route::post('Promotion-create', 'GradeController@Promotion-create')->name('Promotion.create');//دا عشان الايرور بس
        Route::post('Graduated-create', 'GradeController@Graduated-create')->name('Graduated.create');//دا عشان الايرور بس
        Route::post('Graduated-index', 'GradeController@Graduated-index')->name('Graduated.index');//دا عشان الايرور بس
        Route::post('Fees-index', 'GradeController@Fees-index')->name('Fees.index');//دا عشان الايرور بس




});
