<?php

use App\Http\Controllers\Api\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/





Route::group(['namespace' => 'Api\Admin' ,'middleware' => ['api.lang']],function(){
    Route::post('login', 'AuthController@login');//دي عملية اللوجن اللي بيطلع اميله وباسورده موجودين في جدول الادمن بياخد توكن وعن طريقه بيجيب اي داتا تحت

    Route::group(['middleware' => ['auth.api:admin-api']],function(){
        Route::post('logout', 'AuthController@logout');
        // هنا هحط كل الروتات اللي الادمن عاوزها ومحدش يعرف يوصل لهم غير لما يعمل لوجن ويبعت توكن
        Route::post('getdata', 'SubjectController@adminData');
        Route::post('subjects', 'SubjectController@index');
        Route::post('subject', 'SubjectController@getById');
    });

});



