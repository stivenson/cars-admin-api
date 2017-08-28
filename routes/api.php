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
			Route::get('/spe/products/available','ProductController@indexAvailable');
			// logout 
			Route::get('/public/logout','SessionController@invalidateToken');
			Route::get('/public/products/{product}','products.show','ProductController@show');
			Route::post('/public/clients','clients.store', 'ClientController@onlystore'); //save				
			// login 
			Route::post('/public/login','SessionController@getToken');	// for post: email, password

			Route::group(['middleware' => ['before' => 'jwt.auth']], function() {

				Route::group(['middleware' => ['admin']], function () {
					
					Route::get('/clients', 'clients.index', 'ClientController@index');
					Route::post('/clients','clients.store', 'ClientController@store'); //save or update
					Route::get('/clients/{client}','clients.show','ClientController@show');
					Route::get('/temporal/delete/clients/{client}','ClientController@destroy');
					
					Route::get('/orders', 'orders.index', 'OrderController@index');
					Route::post('/orders','orders.store', 'OrderController@store'); //save or update
					Route::get('/orders/{order}','orders.show','OrderController@show');
					Route::get('/temporal/delete/orders/{client}','OrderController@destroy');	
					Route::get('pagination_orders/{skip}/{take}','OrderController@indexPagination');
					
					Route::get('/products', 'products.index', 'ProductController@index');
					Route::post('/products','products.store', 'ProductController@store'); //save or update
					Route::get('/products/{product}','products.show','ProductController@show');										
					Route::get('/temporal/delete/products/{product}','ProductController@destroy');

					Route::get('items_orders/all/{idOrder}','ItemsOrdersController@index');					
					
				});

				Route::group(['middleware' => ['client']], function () {							
					
					Route::post('/orders','orders.store', 'OrderController@onlystore'); // save or update
					
				});					

			});

		});

	});


	/*Route::get('/test/{texto}', function ($texto) {
		return response()->json(['Texto ' => $texto], 200);
	});*/