<?php namespace Factories;

use Car\Order;
use Car\Product;

class Car {
	
	public static function getOrder(){
		return new Order; 
	}
	
	public static function getProduct(){
		return new Product;
	}
}

