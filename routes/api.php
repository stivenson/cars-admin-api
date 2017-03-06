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

//Route::group(['middleware' => ['auth:api']], function () {


	// Special
	Route::get('/spe/products/available','ProductController@indexAvailable');

	Route::resource('clients', 'ClientController',['except' => ['create', 'edit']]);
	Route::resource('orders', 'ClientController',['except' => ['create', 'edit']]);
	Route::resource('products', 'ProductController',['except' => ['create', 'edit']]);


//});