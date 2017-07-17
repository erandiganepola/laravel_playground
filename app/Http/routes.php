<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', [
    'as'   => 'root',
    'uses' => function () {
        return Auth::check() ? view('admin') : view('auth.login');
    }
]);


Route::post('login', ['uses' => 'Auth\AuthController@postLogin']);
Route::get('login', ['uses' => 'Auth\AuthController@getLogin']);

Route::get('twoFactorAuthentication', ['uses' => 'Auth\AuthController@getTwoFactorAuthentication']);
Route::post('twoFactorAuthentication', ['uses' => 'Auth\AuthController@postTwoFactorAuthentication']);

Route::get('logout', ['as' => 'getLogout', 'uses' => 'Auth\AuthController@getLogout']);


/**
 * ======================================================
 * Authentication check before viewing any url
 * ======================================================
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get("examinations", ['as' => 'examinations', 'uses' => 'ExaminationController@getAll']);
    Route::post("addExamination", ['as' => 'addExamination', 'uses' => 'ExaminationController@addExamination']);

    Route::get("student", ['as' => 'student', 'uses' => 'ExaminationController@getAllExaminationsOfCurrentUser']);
    Route::get("student/examApplications",
        ['as' => 'examApplications', 'uses' => 'ExaminationController@getUpComingExaminations']);

    Route::post("student/applyExamination/{id}",
        ['as' => 'applyExamination', 'uses' => 'ExaminationController@applyExamination']);
});