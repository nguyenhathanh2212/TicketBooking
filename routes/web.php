<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app');
})->name('home');

// auth
Route::group(['namespace' => 'Auth', 'prefix' => 'admin-page'], function () {
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@login')->name('login');
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin-page', 'middleware' => 'auth'], function () {
    // dashboard
    Route::get('/', 'HomeController@index')->name('admin');
    //company
    Route::get('company-manage', 'CompanyController@manage')->name('company.manage');
    Route::post('company/update-multy-status', 'CompanyController@updateMultyStatus')->name('company.update_multy_status');
    Route::delete('company/delete-multy', 'CompanyController@deleteMulty')->name('company.delete_multy');
    Route::resource('company', 'CompanyController');
    //user
    Route::post('user/update-multy-status', 'UserController@updateMultyStatus')->name('user.update_multy_status');
    Route::delete('user/delete-multy', 'UserController@deleteMulty')->name('user.delete_multy');
    Route::get('user/search', 'UserController@search')->name('user.search');
    Route::resource('user', 'UserController');
    Route::get('profile', 'UserController@profile')->name('admin.profile');
    Route::put('profile', 'UserController@UpdateProfile')->name('admin.update_profile');
    //station
    Route::post('station/update-multy-status', 'StationController@updateMultyStatus')->name('station.update_multy_status');
    Route::delete('station/delete-multy', 'StationController@deleteMulty')->name('station.delete_multy');
    Route::resource('station', 'StationController');
    //provincial
    Route::resource('provincial', 'ProvincialController');
    // ticket
    Route::resource('ticket', 'TicketController');
    Route::get('ticket-export', 'TicketController@export')->name('export-tickets');

    //route
    Route::post('route/update-multy-status', 'RouteController@updateMultyStatus')->name('route.update_multy_status');
    Route::delete('route/delete-multy', 'RouteController@deleteMulty')->name('route.delete_multy');
    Route::resource('route', 'RouteController');

    //bus
    Route::post('bus/update-multy-status', 'BusController@updateMultyStatus')->name('bus.update_multy_status');
    Route::delete('bus/delete-multy', 'BusController@deleteMulty')->name('bus.delete_multy');
    Route::resource('bus', 'BusController');
});
