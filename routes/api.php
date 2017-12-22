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

			/// public endpoints
			Route::get('/spe/products/available/pagination_products/{skip}/{take}/{category}','ProductController@indexPagination');
			Route::get('/spe/products/available/pagination_products/{skip}/{take}','ProductController@indexPagination');
			// Route::get('/spe/products/available','ProductController@indexAvailable');
			
			// logout 
			Route::get('/public/logout','SessionController@invalidateToken');
			Route::get('/public/products/{product}', 'ProductController@show');
			Route::post('/public/clients', 'ClientController@onlystore'); //save				
			// login 
			Route::post('/public/login','SessionController@getToken');	// for post: email, password

			// refresh
			Route::get('/public/refresh', 'SessionController@refreshToken');
			
			// public check of token
			Route::get('/public/check', 'SessionController@checkToken');			

			Route::group(['middleware' => ['before' => 'jwt.auth']], function() {

				Route::group(['middleware' => 'admin'], function () {
					
					Route::get('/clients', 'ClientController@index');
					Route::post('/clients', 'ClientController@store'); //save or update
					Route::get('/clients/order/{select}/{withAdmins}', 'ClientController@index');
					Route::get('/clients/{client}','ClientController@show');
					Route::get('/temporal/delete/clients/{client}','ClientController@destroy');
					
					Route::get('/orders', 'OrderController@index');
					Route::post('/orders', 'OrderController@store'); //save or update
					Route::get('/orders/{order}','OrderController@show');
					Route::get('/temporal/delete/orders/{client}','OrderController@destroy');	
					Route::get('pagination_orders/{skip}/{take}/{category}','OrderController@indexPagination');
					Route::get('pagination_orders/{skip}/{take}','OrderController@indexPagination');
					
					Route::get('/products', 'ProductController@index');
					Route::post('/products', 'ProductController@store'); //save or update
					Route::get('/products/{product}', 'ProductController@show');										
					Route::get('/temporal/delete/products/{product}','ProductController@destroy');

					Route::get('items_orders/all/{idOrder}','ItemsOrdersController@index');					
					
				});

				Route::group(['middleware' => 'client'], function () {							
					
					Route::post('client/orders', 'OrderController@onlystore'); // save
					
				});					

			});

		});

	});


	/*Route::get('/test/{texto}', function ($texto) {
		return response()->json(['Texto ' => $texto], 200);
	});*/