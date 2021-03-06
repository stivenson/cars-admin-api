<?php namespace Users;

use Abstracts\Resource;
use Hash;

class Admin extends Resource {
	const ROLE = 1;
	public function list() {
		return User::where('roles_id',self::ROLE)->get();
	}

	public function find($id) {
		$o = User::find($id);
		return !is_null($o) ? $o : false;
	}
	
	public function save($attr) {
		$o = new User();
		$attr->roles_id = self::ROLE;
		$password = $attr['password'];
		$attr['password'] = Hash::make($password);
		$o->fill($attr);
		return $o->save() ? $o: false;
	}
	
	public function update($id,$attr) {
		$o = User::find($id);
		$attr->roles_id = self::ROLE;
		$password = $attr['password'];
		if(trim($password) != '')
			$attr['password'] = Hash::make($password);
		$o->fill($attr);
		return $o->save() ? $o: false;
	}
	
	public function delete($id) {
		$o = User::find($id);
		$o->delete();
	}
}