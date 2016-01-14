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

use App\User;


Route::get('/', function () {
    return Auth::check() ? view('admin')->with('student',Auth::user()) : view('auth.login');
});


Route::any('studentLogin',['as'=>'studentLogin','uses'=>'StudentController@login']);
Route::get('logout',['as'=>'getLogout','uses'=>'StudentController@logout']);

/**
 *  Rest API Linkage
 */

Route::get("rest/examResults/all/" , ["as"=>"AllExamResultsRest", 'uses'=>'RESTAPIController@allResults']);

/**
 * ======================================================
 * Authentication check before viewing any url
 * ======================================================
 */
Route::group(['middleware' => 'auth'], function () {

    Route::get('application',['as'=>'submitApplication','uses'=>'ApplicationController@create']);
    Route::get('viewApplication',['as'=>'viewApplication','uses'=>'ApplicationController@show']);


});








































/**
 * ====================================================
 * Test function to create a user
 * ====================================================
 */
Route::get('register', function () {
    $user = new User;
    $user->username = 'sms';
    $user->password = Hash::make('sms');
    $user->type='A';
    $user->save();

    return $user->password;
});

Route::get('users', function () {
    $users = User::all();
    return $users;
});
