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


Route::group(['namespace' => 'Admin', 'prefix' => 'admin-page'], function () {
    Route::get('/', 'HomeController@index')->name('admin');
    Route::resource('company', 'CompanyController');
    Route::resource('user', 'UserController');
    Route::resource('station', 'StationController');
    Route::resource('provincial', 'ProvincialController');
});
