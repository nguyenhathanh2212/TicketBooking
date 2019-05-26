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
    Route::get('/', 'HomeController@index')->name('admin');
    //company
    Route::post('company/update-multy-status', 'CompanyController@updateMultyStatus')->name('company.update_multy_status');
    Route::delete('company/delete-multy', 'CompanyController@deleteMulty')->name('company.delete_multy');
    Route::resource('company', 'CompanyController');
    //user
    Route::get('user/search', 'UserController@search')->name('user.search');
    Route::resource('user', 'UserController');
    //station
    Route::post('station/update-multy-status', 'StationController@updateMultyStatus')->name('station.update_multy_status');
    Route::delete('station/delete-multy', 'StationController@deleteMulty')->name('station.delete_multy');
    Route::resource('station', 'StationController');
    //provincial
    Route::resource('provincial', 'ProvincialController');
    // ticket
    Route::resource('ticket', 'TicketController');

    //route
    Route::post('route/update-multy-status', 'RouteController@updateMultyStatus')->name('route.update_multy_status');
    Route::delete('route/delete-multy', 'RouteController@deleteMulty')->name('route.delete_multy');
    Route::resource('route', 'RouteController');

    //route
    Route::post('bus/update-multy-status', 'BusController@updateMultyStatus')->name('bus.update_multy_status');
    Route::delete('bus/delete-multy', 'BusController@deleteMulty')->name('bus.delete_multy');
    Route::resource('bus', 'BusController');
});
