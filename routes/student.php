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

    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']

], function () {

    Route::group(['namespace' => 'User'], function () {

        Route::get('dashboard', 'HomeeController@student');
        Route::get('create', 'HomeeController@create')->name('xxx');
    });
});
