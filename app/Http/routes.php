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

    /**
     * Routes related to the students
     */
    Route::get('students',['as'=>'students','uses'=>'StudentController@index']);
    Route::get('addStudent',['as'=>'addStudent','uses'=>'StudentController@create']);
    Route::post('addStudent',['as'=>'addStudent','uses'=>'StudentController@store']);

    /**
     * Routes related to parents
     */
    Route::post('getParent/{nic}',['as'=>'getParent','uses'=>'ParentController@hasParent']);


    /**
     * Routes related to teachers
     */
    Route::get('teachers',['as'=>'teachers','uses'=>'TeacherController@index']);
    Route::get('addTeacher',['as'=>'addTeacher','uses'=>'TeacherController@create']);
    Route::post('addTeacher',['as'=>'addTeacher','uses'=>'TeacherController@store']);



    /**
     * Routes related to testing purposes
     */
    Route::get('test', ['as'=>'test', 'uses' => 'TestController@show']);



    /**
     * Routes related to classes
     */
    Route::get('classes',['as'=>'classes','uses'=>'ClassController@index']);
    Route::get('addClass',['as'=>'addClass','uses'=>'ClassController@create']);
    Route::post('addClass',['as'=>'addClass','uses'=>'ClassController@store']);



    /**
     * Routes related to settings
     */
    Route::get('settings',['as'=>'settings','uses'=>function(){
        return View('Settings.settings');
    }]);


    /**
     * Routes related to profiles
     */
    Route::get('profile',['as'=>'profile','uses'=>function(){
        return View('Settings.profile');
    }]);

    /**
     * Routes related to Instruments
     */
    Route::get('instruments',['as'=>'instruments','uses'=>'InstrumentController@index']);
    Route::get('addInstrument',['as'=>'addInstrument','uses'=>'InstrumentController@create']);
    Route::post('addInstrument',['as'=>'addInstrument','uses'=>'InstrumentController@store']);

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
