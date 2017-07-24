<?php

namespace senseibistro\Http\Controllers;

use Illuminate\Http\Request;
use Factories\Car;

class ItemsOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idOrder)
    {
        return response()->json(Car::getOrder()->listItemsOfOrder($idOrder), 200);
    }

}
