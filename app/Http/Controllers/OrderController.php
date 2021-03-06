<?php

namespace carsadmin\Http\Controllers;

use Illuminate\Http\Request;
use Factories\Car;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Car::getOrder()->listStatus(), 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPagination($skip, $take)
    {
        return response()->json(Car::getOrder()->listStatusPagination(0, $skip, $take), 200);
    }
    /**
     * Display a listing of the resource with filter of type_delivery.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTypeDelivery($type)
    {
        return response()->json(Car::getOrder()->listTypeDelivery($type), 200);
    }
    
    /**
     * Display a listing of the resource with filter of status.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexStatus($type)
    {
        return response()->json(Car::getOrder()->listStatus($type), 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($client)
    {
        return response()->json(Car::getOrder()->find($client), 200);
    }
    
    /**
     * Store a newly created resource in storage (and update).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $inputs = $this->request->all();
        return response()->json(Car::getOrder()->save($inputs), 200);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function onlystore()
     {
        $inputs = $this->request->all();
        unset($inputs['id']);
        return response()->json(Car::getOrder()->save($inputs), 200);
     }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($client)
    {
        $inputs = $this->request->all();
        return response()->json(Car::getOrder()->update($client,$inputs), 200);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($client)
    {
        return response()->json(Car::getOrder()->delete($client), 200);
    }
}
