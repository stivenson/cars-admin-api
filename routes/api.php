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
			Route::resource('clients', 'ClientController',['except' => ['create', 'edit']]);
			Route::get('clients/order/{select}','ClientController@index');
			Route::resource('orders', 'OrderController',['except' => ['create', 'edit']]);

			// Temporal for problems with cors ########
			// ACA TENGO UN PROBLEMA con la configuración de los cors pues el put y el delete no funcionan // cuando los llamo desde mithrilm es una configuración faltante en alguna de las dos partes,
			// api o cliente web.

			Route::get('/temporal/delete/products/{product}','ProductController@destroy');
			Route::get('/temporal/delete/clients/{client}','ClientController@destroy');
			Route::get('/temporal/delete/orders/{client}','OrderController@destroy');	

			Route::group(['middleware' => ['before' => 'jwt.auth']], function() {

				Route::group(['middleware' => ['admin','client']], function () {
					// REST resources
					// 
					// TEMPORALMENTE los endpoints que deberían estar restringidos a estos roles, están publicos para facilitar el desarrollo pues todavía no se ha terminado el login del admin, donde el mismo inicio sesión, ni de la vista publica del carrito en donde el usuario inicia sesión.
					
				});

			});
		});

	});


	/*Route::get('/test/{texto}', function ($texto) {
		return response()->json(['Texto ' => $texto], 200);
	});*/