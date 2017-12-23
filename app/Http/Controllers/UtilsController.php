<?php

namespace senseibistro\Http\Controllers;

use Illuminate\Http\Request;
use Helpers\Time;

class UtilsController extends Controller
{

	/**
	 * return current hour to client
	 * @return String
	 */
    public function getCurrentHour() {

    	$time = new Time;
    	return response()->json($time->getCurrentHour(), 200);

    }

}
