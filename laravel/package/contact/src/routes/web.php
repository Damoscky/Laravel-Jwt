<?php


Route::group(['namespace' => 'Damoscky\Contact\Http\Controllers'], function($router){
    Route::get('contact', 'ContactController@index');
    Route::post('contact', 'ContactController@store')->name('contact');
});
