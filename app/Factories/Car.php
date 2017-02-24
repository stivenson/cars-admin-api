<?php namespace Factories;

use Car\Order;
use Car\Product;

class Car {
	
	public function getOrder(){
		return new Order; 
	}
	
	public function getProduct(){
		return new Product;
	}
}

