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
Route::get('user/confirmation/{code}', ['as' => 'userConfirmation', 'uses' => 'PagesController@showConfirmation']);
Route::patch('user/setup/{id}', ['as' => 'setup', 'uses' => 'PagesController@setup']);
Route::get('admin', ['as' => 'admin', 'uses' => 'AdminController@index']);
Route::post('admin/login', ['as' => 'login', 'uses' => 'AdminController@login']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('adviser/dashboard', ['as' => 'adviserDashboard', 'uses' => 'AdviserController@index']);
    Route::get('adviser/logout', ['as' => 'adviserLogout', 'uses' => 'AdviserController@logout']);
    Route::get('adviser/signature', ['as' => 'adviserSignature', 'uses' => 'AdviserController@signature']);
    Route::post('adviser/signature/generate', ['as' => 'adviserGenerateSignature', 'uses' => 'AdviserController@generateSignature']);
    Route::get('adviser/users/students', [ 'as' => 'myStudents', 'uses' => 'AdviserController@showStudents']);
    Route::get('adviser/logs', [ 'as' => 'adviserActivityLogs', 'uses' => 'AdviserController@showLogs']);
    Route::get('adviser/chat/refresh', ['as' => 'adviserChatRefresh', 'uses' => 'AdviserController@chatRefresh']);
    Route::get('adviser/logs/deleted', ['as' => 'adviserDeletedLogs', 'uses' => 'AdviserController@deletedLogs']);
    Route::get('adviser/logs/current', ['as' => 'adviserActiveLogs', 'uses' => 'AdviserController@activeLogs']);
    Route::get('adviser/logs/reset', ['as' => 'adviserResetLogs', 'uses' => 'AdviserController@resetLogs']);
    Route::get('adviser/logs/restore', ['as' => 'adviserRestoreLogs', 'uses' => 'AdviserController@restoreLogs']);
    Route::get('adviser/user/profile', ['as' => 'adviserProfile', 'uses' => 'AdviserController@profile']);
    Route::patch('adviser/user/profile/picture/update', ['as' => 'adviserChangeDP', 'uses' => 'AdviserController@changeDP']);
    Route::get('adviser/user/profile/email/update', ['as' => 'adviserSetEmail', 'uses' => 'AdviserController@setEmail']);
    Route::patch('adviser/user/profile/email/update', ['as' => 'adviserUpdateEmail', 'uses' => 'AdviserController@updateEmail']);
    Route::get('adviser/user/profile/password/update', ['as' => 'adviserSetPass', 'uses' => 'AdviserController@setPassword']);
    Route::patch('adviser/user/profile/password/update', ['as' => 'adviserUpdatePass', 'uses' => 'AdviserController@updatePassword']);
});

Route::group(['middleware' => 'admin'], function() {
    Route::get('admin/logout', ['as' => 'logout', 'uses' => 'AdminController@logout']);
    Route::get('admin/dashboard', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard']);
    Route::get('admin/signature', ['as' => 'signature', 'uses' => 'AdminController@signature']);
    Route::post('admin/signature/generate', ['as' => 'generateSignature', 'uses' => 'AdminController@generateSignature']);
    Route::get('admin/users/students', [ 'as' => 'collectionStudent', 'uses' => 'AdminController@showStudents']);
    Route::get('admin/users/advisers', [ 'as' => 'collectionAdviser', 'uses' => 'AdminController@showAdvisers']);
    Route::get('admin/logs', [ 'as' => 'activityLogs', 'uses' => 'AdminController@showLogs']);
    Route::get('admin/chat/refresh', ['as' => 'chatRefresh', 'uses' => 'AdminController@chatRefresh']);
    Route::get('admin/logs/deleted', ['as' => 'deletedLogs', 'uses' => 'AdminController@deletedLogs']);
    Route::get('admin/logs/current', ['as' => 'activeLogs', 'uses' => 'AdminController@activeLogs']);
    Route::get('admin/logs/reset', ['as' => 'resetLogs', 'uses' => 'AdminController@resetLogs']);
    Route::get('admin/logs/restore', ['as' => 'restoreLogs', 'uses' => 'AdminController@restoreLogs']);
    Route::get('admin/user/profile', ['as' => 'profile', 'uses' => 'AdminController@profile']);
    Route::patch('admin/user/profile/picture/update', ['as' => 'changeDP', 'uses' => 'AdminController@changeDP']);
    Route::get('admin/user/profile/email/update', ['as' => 'setEmail', 'uses' => 'AdminController@setEmail']);
    Route::patch('admin/user/profile/email/update', ['as' => 'updateEmail', 'uses' => 'AdminController@updateEmail']);
    Route::get('admin/user/profile/password/update', ['as' => 'setPass', 'uses' => 'AdminController@setPassword']);
    Route::patch('admin/user/profile/password/update', ['as' => 'updatePass', 'uses' => 'AdminController@updatePassword']);
    Route::get('admin/department', ['as' => 'departments', 'uses' => 'AdminController@showDepartments']);
    Route::post('admin/department/add', ['as' => 'addDepartment', 'uses' => 'AdminController@addDepartment']);
});
