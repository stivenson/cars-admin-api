<?php namespace Users;

use Abstracts\Resource;

class Admin extends Resource {
	const ROLE = 1;
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