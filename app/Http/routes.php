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
    Log::info(Auth::user());
    return Auth::check() ? view('admin') : view('auth.login');
});


Route::post('login',['uses'=>'Auth\AuthController@postLogin']);
Route::get('login',['uses'=>'Auth\AuthController@getLogin']);

Route::get('logout',['as'=>'getLogout','uses'=>'Auth\AuthController@getLogout']);


/**
 * ======================================================
 * Authentication check before viewing any url
 * ======================================================
 */
Route::group(['middleware' => 'auth'], function () {

});


/**
 * Test function to create a user
 */
Route::get('register', function () {
    $user = new User;
    $user->username = 'admin';
    $user->password = Hash::make('admin');
    $user->type='A';
    $user->save();

    return $user->password;
});