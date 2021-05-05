<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('mobile_chat', 'MobileController@mobile_chat');
// Route::post('mobile_login', 'MobileController@mobile_login');
// Route::post('mobile_home', 'MobileController@mobile_home');
// Route::post('mobile_select_date', 'MobileController@mobile_select_date');
// Route::post('mobile_exam_live', 'MobileController@mobile_exam_live');
// Route::post('mobile_exam_submit', 'MobileController@mobile_exam_submit');
// Route::post('mobile_exam_results', 'MobileController@mobile_exam_results');

// REGISTER

// Route::post('getProvinces', 'MobileController@getProvinces');
// Route::post('getCities', 'MobileController@getCities');
// Route::post('getPrograms', 'MobileController@getPrograms');
// Route::post('mobile_register', 'MobileController@mobile_register');

// Route::post('android_home', 'AndroidController@index');
// Route::post('android_login', 'AndroidController@login');
// Route::post('android_register', 'AndroidController@register');
// Route::post('android_select_date', 'AndroidController@select_date');
// Route::post('android_exam_live', 'AndroidController@exam_live');
// Route::post('android_submit', 'AndroidController@submit');
// Route::post('android_show_result', 'AndroidController@result');
// Route::post('android_chat', 'AndroidController@chat');
