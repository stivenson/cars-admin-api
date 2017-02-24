<?php namespace Abstracts;
	
use Models\User;
use Models\Role;

abstract class Resource {
	
	public getRole ($idUser){
		$u = User::find($idUser);

		if(is_null($u))
			return false;
		else
			return Role::find($u->roles_id);
	}

	abstract public function save($attr);
}