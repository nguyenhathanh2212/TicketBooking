<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'API'], function () {
    Route::resource('company', 'CompanyController');
    Route::get('company/{id}/rating', 'CompanyController@getRatings');
    Route::resource('bus-route', 'BusRouteController');
    Route::resource('bus-station', 'StationController');
    Route::resource('provincial', 'ProvincialController');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('company/{id}/rating', 'CompanyController@rate')->name('company.rating.rate');
    });

    // Auth
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::get('unauthorized', 'AuthController@unauthorized')->name('unauthorized');
        Route::group(['middleware' => 'auth:api'], function() {
            Route::get('user', 'AuthController@getUser');
            Route::post('logout', 'AuthController@logout');
        });
    });
});
