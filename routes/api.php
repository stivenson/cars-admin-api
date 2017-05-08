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
Route::middleware('auth:api')->get('/users', function (Request $request) {
    return $request->user();
});
*/

/*
Route::group(['middleware' => ['auth:api']], function () {
});
*/

	Route::group(['prefix' => 'v1'], function () {

		Route::group(['middleware' => ['web']], function () {

			// public endpoints
			Route::get('/spe/products/available','ProductController@indexAvailable');

			// resources temporally public
			Route::resource('products', 'ProductController',['except' => ['create', 'edit']]);

			// Temporal for problems with cors ########
			Route::get('/temporal/delete/products/{product}','ProductController@destroy');

			Route::group(['middleware' => ['before' => 'jwt.auth']], function() {

				Route::group(['middleware' => ['admin','client']], function () {
					// REST resources
					Route::resource('clients', 'ClientController',['except' => ['create', 'edit']]);
					Route::resource('orders', 'ClientController',['except' => ['create', 'edit']]);
					
				});

			});
		});

	});


	/*Route::get('/test/{texto}', function ($texto) {
		return response()->json(['Texto ' => $texto], 200);
	});*/