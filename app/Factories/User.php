<?php namespace Factories;
use Users\Client;
use Users\Admin;
class User {
	
	public static function getListClient(){
		$c = new Client;
		return $c->getList();
	}

	public static function getClient(){
		return new Client;
	}

	public static function getAdmin(){
		return new Admin;
	}

}
