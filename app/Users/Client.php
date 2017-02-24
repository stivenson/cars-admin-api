<?php namespace Users;

use Abstracts\Resource;
use Models\User;

class Client extends Resource {
	const ROLE = 2;
	public function getList() {
		return User::where('roles_id',self::ROLE)->get();
	}

	public function save($attr) {
		$o = new User();
		$attr->roles_id = self::ROLE;
		$o->fill($attr);
		$o->save();
	}

}