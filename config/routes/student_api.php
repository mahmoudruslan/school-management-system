<?php

use App\Http\Controllers\Api\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;

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


Route::group(['namespace' => 'Api\User' ,'middleware' => ['api.lang']],function(){
    Route::post('login', [AuthController::class, 'login']);//دي عملية اللوجن اللي بيطلع اميله وباسورده موجودين في جدول الطلاب بياخد توكن وعن طريقه بيجيب اي داتا تحت


    Route::group(['middleware' => ['auth.api:user-api']],function(){
        Route::post('logout', [AuthController::class, 'logout']);
        // هنا هحط كل الروتات اللي الادمن عاوزها ومحدش يعرف يوصل لهم غير لما يعمل لوجن ويبعت توكن
        Route::post('profile', function(){
            return \Auth::user();
        });

    });
});


