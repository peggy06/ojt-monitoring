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

Route::get('', ['as' => 'index', 'uses' => 'PagesController@index']);
Route::get('login', ['as' => 'showLogin', 'uses' => 'PagesController@showLoginForm']);
Route::post('login', ['as' => 'userLogin', 'uses' => 'PagesController@login']);
Route::get('register', ['as' => 'showRegistration', 'uses' => 'PagesController@showRegistrationForm']);
Route::post('register', ['as' => 'userRegister', 'uses' => 'PagesController@register']);
Route::get('user/{code}/confirmation', ['as' => 'userConfirmation', 'uses' => 'PagesController@showConfirmation']);

//Admin
Route::get('admin', ['as' => 'admin', 'uses' => 'AdminController@index']);
Route::post('admin/login', ['as' => 'login', 'uses' => 'AdminController@login']);
Route::get('admin/logout', ['as' => 'logout', 'uses' => 'AdminController@logout']);
Route::get('admin/dashboard', ['as' => 'dashboard', 'middleware' => 'admin', 'uses' => 'AdminController@dashboard']);
Route::get('admin/signature', ['as' => 'signature', 'middleware' => 'admin', 'uses' => 'AdminController@signature']);
Route::post('admin/signature/generate', ['as' => 'generateSignature', 'middleware' => 'admin', 'uses' => 'AdminController@generateSignature']);
Route::get('admin/users/students', [ 'as' => 'collectionStudent', 'middleware' => 'admin', 'uses' => 'AdminController@showStudents']);