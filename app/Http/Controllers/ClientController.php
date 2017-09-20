<?php

namespace carsadmin\Http\Controllers;

use Illuminate\Http\Request;
use Factories\User;

class ClientController extends Controller
{ 
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index($select = false, $withAdmins = 'no') 
    {   
    	return response()->json(User::getClient()->listAll($select, $withAdmins), 200); 
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($client) 
    {
    	return response()->json(User::getClient()->find($client), 200);
    }

    /**
     * Store a newly created resource in storage (or update).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store() 
    {
    	$inputs = $this->request->all();
    	return response()->json(User::getClient()->save($inputs), 200);
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
         return response()->json(User::getClient()->save($inputs), 200);
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
    	return response()->json(User::getClient()->update($client,$inputs), 200);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($client) 
    {
    	return response()->json(User::getClient()->delete($client), 200);
    }
    
}
