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

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::resource('company', 'CompanyController');
    Route::resource('user', 'UserController');
    Route::resource('station', 'StationController');
    Route::resource('provincial', 'ProvincialController');
});
