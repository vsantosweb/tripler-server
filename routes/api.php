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
/*
    |--------------------------------------------------------------------------
    | BackOffice Routes
    |--------------------------------------------------------------------------
    |Rotas de consumo da web, será enviada para o site público.
    |
    */

Route::prefix('v1')->namespace('Api\v1')->group(function () {

    Route::prefix('backoffice')->namespace('BackOffice')->group(function () {
        Route::namespace('User')->group(function () {
            Route::resource('users', 'UserController');
            Route::prefix('user/auth')->namespace('Auth')->group(function () {
                Route::post('login', 'UserAuthController@login');
                Route::middleware('auth:user')->group(function () {
                    Route::get('logged', 'UserAuthController@logged');
                    Route::post('logout', 'UserAuthController@logout');
                });
            });
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Client Routes
    |--------------------------------------------------------------------------
    |Rotas de consumo da web, será enviada para o site público e
    |consumida fora do backoffice.
    |
    */
    Route::middleware('auth:agency')->group(function () {
        Route::resource('client/agency/trips', 'BackOffice\Trip\TripController');
    });
    Route::prefix('client')->namespace('Client')->group(function () {

        /* Customer Agency Routes */
        Route::prefix('agency')->namespace('Agency')->group(function () {

            Route::prefix('auth')->namespace('Auth')->group(function () {
                Route::post('login', 'AgencyAuthController@login');
                Route::prefix('register')->group(function () {
                    Route::post('/', 'AgencyRegisterController@register');
                });
                Route::middleware('auth:agency')->group(function () {
                    Route::get('logged', 'AgencyAuthController@logged');
                    Route::post('logout', 'AgencyAuthController@logout');
                });
            });
            Route::middleware('auth:agency')->group(function () {
                Route::get('trip-schedules', 'AgencyController@trips');
            });
        });

        /* Customer  Routes */
        Route::prefix('customer')->namespace('Customer')->group(function () {
            Route::prefix('auth')->namespace('Auth')->group(function () {
                Route::prefix('register')->group(function () {
                    Route::post('/', 'CustomerRegisterController@register');
                    Route::post('/emailverify', 'CustomerRegisterController@registerConfirmation');
                });
                Route::post('login', 'CustomerAuthController@login');
                Route::post('social-login', 'CustomerSocialLoginController@login');
                Route::middleware('auth:customer')->group(function () {
                    Route::get('logged', 'CustomerAuthController@logged');
                    Route::post('logout', 'CustomerAuthController@logout');
                });
            });

           

            Route::middleware('auth:customer')->group(function () {
                
                Route::post('carts', 'CustomerTripCartController@add');
                Route::get('carts', 'CustomerTripCartController@list');
                Route::get('carts/{code}', 'CustomerTripCartController@show');
                Route::patch('carts/{code}', 'CustomerTripCartController@change');
                Route::delete('carts/{code}', 'CustomerTripCartController@delete');

                Route::post('orders', 'CustomerOrderController@create');
                Route::get('orders', 'CustomerOrderController@index');
                Route::get('orders/{code}', 'CustomerOrderController@show');
                Route::post('orders/payment', 'CustomerOrderController@payment');

                Route::get('carts/{code}/calculate', 'CustomerTripCartController@calculate');

                Route::post('booking', 'CustomerBookingController@createBooking');
                Route::patch('booking/{booking_code}/confirm', 'CustomerBookingController@confirmBooking');
                Route::post('booking/{booking_code}/payment', 'CustomerBookingController@bookingPayment');
                Route::delete('booking/{booking_code}/cancel-by-customer', 'CustomerBookingController@bookingCancelByCustomer');

            });
        });

        /* Public  Routes */
        Route::prefix('public')->namespace('Site')->group(function () {
            Route::get('trips-by-category', 'SiteTripController@tripsByCategory');
            Route::get('trips/{uuid}', 'SiteTripController@show');
            Route::prefix('trip')->group(function () {
                Route::get('schedule', 'SiteTripController@schedules');
                Route::get('schedule/categories', 'SiteTripController@scheduleCategories');
                Route::get('schedule/{uuid}', 'SiteTripController@showSchedule');
                Route::get('passenger-types', 'SiteTripController@passengerTypes');
                Route::get('additional-packages/{code}', 'SiteTripController@additionalPackages');
                Route::get('trip-boarding-locations/{code}', 'SiteTripController@tripBoardingLocationList');
                Route::get('categories', 'SiteTripController@tripCategeories');
                Route::get('categories/{categoryCode}', 'SiteTripController@schedulesByCategory');
            });
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Post Back URLs
    |--------------------------------------------------------------------------
    */

    Route::prefix('postback')->group(function () {
        Route::namespace('Client\Customer')->group(function () {
            Route::post('booking-transaction', 'CustomerBookingController@getPostbackTransaction');
        });
    });
});
