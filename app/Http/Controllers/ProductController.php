<?php

namespace carsadmin\Http\Controllers;

use Illuminate\Http\Request;
use Factories\Car;  

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json(Car::getProduct()->listR(false), 200);
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 public function indexPagination($skip, $take)
	 {
		 return response()->json(Car::getProduct()->listRPagination(true, $skip, $take), 200);
	 }


	/**
	 * Display a listing of the resource with available filter.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function indexAvailable()
	{
		return response()->json(Car::getProduct()->listR(true), 200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($product)
	{
		return response()->json(Car::getProduct()->find($product), 200);
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store()
	{
		$inputs = $this->request->all();
		return response()->json(Car::getProduct()->save($inputs), 200);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update($product)
	{
		$inputs = $this->request->all();
		return response()->json(Car::getProduct()->update($product,$inputs), 200);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($product)
	{
		return response()->json(Car::getProduct()->delete($product), 200);
	}

	public function shareFacebook($product) 
	{
		$withLink = true;
		return \View::make('product-share-facebook')->with(Car::getProduct()->getProductForFacebookWith($product, ['name', 'description'], $withLink));
	}

	public function shareImageFacebook($product){
		$withLink = false;
		$array = Car::getProduct()->getProductForFacebookWith($product, ['image1', 'mime'], $withLink);
		return response($array['image1'], 200)->header('Content-Type', 'image/'.$array['mime']);
	}
}
