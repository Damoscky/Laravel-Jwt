<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function($router){
    Route::get('/test', function(){
        return "Hello";
    });

    Route::group(['prefix' => 'auth'], function($router){
        Route::post('login', 'Auth\LoginController@login');
        Route::post('signup', 'Auth\RegisterController@register');
    });

    Route::group(['prefix' => 'paystack'], function($router){
        Route::post('verifyBVN', 'v1\Paystack\VerificationController@store');
        Route::post('verifyBVN/test', 'v1\Paystack\VerificationController@verify');
    });
});
