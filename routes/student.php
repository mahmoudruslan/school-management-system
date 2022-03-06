<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']], function () {


    // Route::group(['namespace' => 'Teachers'], function () {
    //     Route::resource('Teachers', 'TeachersController');
    // });

});
