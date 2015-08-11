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

Route::post('auth/login', 'AccountControllerClient@postLogin');

Route::get('users', 'UsersController@index');
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::post('users/edit/{id}/{usernumber}', 'UsersController@update');
Route::post('users/delete', 'UsersController@delete');
Route::post('users/activate', 'UsersController@activate');
Route::post('users/deactivate', 'UsersController@deactivate');
Route::get('users/edit/{id}/{usernumber}', 'UsersController@edit');
Route::get('users/show/{id}/{usernumber}', 'UsersController@show');
Route::post('users/show/{id}/{usernumber}', 'UsersController@newShift');

Route::get('attendance/index', array('as' => 'attendance/index', 'uses' => 'AttendanceController@index'));
Route::post('attendance/index', array('as' => 'attendance/index', 'uses' => 'AttendanceController@stop'));
//Route::get('attendance/index', 'AttendanceController@index');
//Route::post('attendance/index', 'AttendanceController@stop');
Route::post('attendance/verification-details', 'AttendanceController@show');
Route::post('attendance/verification-details/{usernumber}', 'AttendanceController@show');

Route::get('reports', 'ReportsController@index');
Route::get('reports/logs/users', 'ReportsController@userLogs');
Route::get('reports/logs/users/date', 'ReportsController@userLogsShowDate');
Route::get('reports/logs/users/id', 'ReportsController@userLogsShowEmployeeNumber');
Route::get('reports/logs/users/name', 'ReportsController@userLogsShowName');
Route::get('reports/logs/accounts', 'ReportsController@accountLogs');
Route::post('reports/logs/accounts', 'ReportsController@accountLogsShow');

Route::get('accounts', 'AccountsController@index');
Route::get('accounts/create', 'AccountsController@create');
Route::post('accounts', 'AccountsController@store');
Route::post('accounts/edit/{id}/{username}', 'AccountsControllerr@update');
Route::post('accounts/delete', 'AccountsController@delete');
Route::get('accounts/edit/{id}/{username}', 'AccountsController@edit');
Route::get('accounts/show/{id}/{username}', 'AccountsController@show');
Route::get('accounts/resetpass/{id}', 'AccountsController@resetPass');
Route::get('accounts/passedit', 'AccountsController@passEdit');
Route::post('accounts/resetpass/{id}', 'AccountsController@resetUpdate');
Route::post('accounts/passedit', 'AccountsController@changePass');

Route::get('/home', 'AccountController@getLogin');
Route::post('/login', 'AccountController@postLogin');
Route::get('/logout', 'AccountController@getLogout');
Route::get('/logoutc', 'Auth\AuthController@getLogout');
Route::get('register', 'RegisterController@show');
Route::post('register', 'RegisterController@store');
Route::get('list', 'RegisterController@index');
Route::get('acc/edit/{id}', 'RegisterController@edit');
Route::post('acc/del', 'RegisterController@delete');
Route::get('acc/deleted', 'RegisterController@deleted');
Route::post('acc/des', 'RegisterController@destroy');
Route::post('acc/up', 'RegisterController@update');