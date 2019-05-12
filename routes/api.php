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
    Route::resource('route', 'RouteController');
    Route::resource('bus-route', 'BusRouteController');
    Route::get('bus-route/{id}/rating', 'BusRouteController@getRatings');
    Route::resource('bus-station', 'StationController');
    Route::get('provincial/popular', 'ProvincialController@popular');
    Route::resource('provincial', 'ProvincialController');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('company/{id}/rating', 'CompanyController@rate')->name('company.rating.rate');
        Route::post('bus-route/{id}/rating', 'BusRouteController@rate')->name('bus-route.rating.rate');
        Route::post('ticket', 'TicketController@store')->name('ticket.store');
        Route::get('ticket/{id}', 'TicketController@show')->name('ticket.show');
        Route::get('my-bookings', 'TicketController@getAuthBookings')->name('ticket.get_auth_bookings');
    });
    // Auth
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
        Route::get('/redirect/{social}', 'SocialAuthController@redirect');
        Route::get('/callback/{social}', 'SocialAuthController@callback');
        Route::post('/login_social', 'SocialAuthController@handleProviderCallback');
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::get('unauthorized', 'AuthController@unauthorized')->name('unauthorized');
        Route::group(['middleware' => 'auth:api'], function() {
            Route::get('user', 'AuthController@getUser');
            Route::patch('update', 'AuthController@update');
            Route::post('logout', 'AuthController@logout');
        });
    });
});
