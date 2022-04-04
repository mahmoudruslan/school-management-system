<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register student routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "student" middleware group. Enjoy building your student!
|
*/
Route::group([
    
    'prefix' => LaravelLocalization::setLocale() .'/'.'student',

    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],

    'namespace' => 'User'

], function () {
    Route::get('student/reset/password', function () {
        return view('student_dashboard.pages.reset_password');
    })->name('reset.form');
    Route::post('student/reset/password', 'User\HomeController@resetPassword')->name('reset.password');
});
Route::group([
    
    'prefix' => LaravelLocalization::setLocale() .'/'.'student',

    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student'],

    'namespace' => 'User'

], function () {


        Route::get('dashboard', 'HomeController@student');
        Route::get('student/data', 'HomeController@getData')->name('student.data');
        Route::get('student/results', 'HomeController@getResults')->name('student.results');
        Route::get('student/courses', 'HomeController@getCourses')->name('student.courses');
        Route::get('student/fees', 'HomeController@getFees')->name('student.fees');
        Route::get('exams/table', 'HomeController@getExams')->name('exams.table');
        Route::get('student/absence', 'HomeController@getAbsence')->name('student.absence');
        Route::get('student/books', 'HomeController@getBooks')->name('student.books');
        Route::get('student/settings', 'HomeController@setting')->name('student.settings');
        Route::patch('student/edit/password', 'HomeController@editPassword')->name('edit.password');
        Route::get('download/{id}', 'HomeController@download')->name('books.download');

        
});
