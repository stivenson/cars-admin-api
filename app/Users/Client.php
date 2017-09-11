<?php namespace Users;

use Abstracts\Resource;
use Models\User;
use Hash;

class Client extends Resource {

    const ROLE = 2;
    public function listAll($select, $withAdmins) {
        if($select){
            $orderparam = 'name'; 
            $order = 'ASC';
        } else {
            $orderparam = 'id'; 
            $order = 'DESC';
        }

        if($withAdmins != 'no')
            return User::orderBy($orderparam, $order)->get();
        else
            return User::where('roles_id',self::ROLE)->orderBy($orderparam, $order)->get();
    }
    
    public function find($id) {
        $o = User::find($id);
        return !is_null($o) ? $o : false;
    }

    public function save($attr) {
            if(isset($attr['id'])){
                $this->update($attr['id'],$attr);
            }else{
                if($this->checkEmail($attr['email'])){
                    return 'email_invalid';
                }
                $o = new User();
                $attr['roles_id'] = self::ROLE;
                $password = $attr['password'];
                $attr['password'] = Hash::make($password);
                $o->fill($attr);
                return $o->save();  
            }
    }

    private function checkEmail($email, $omitId = false){
        if($omitId == false){
            $count = User::where('email', $email)->count();
        } else {
            $count = User::where('email', $email)->where('id', '!=', $omitId)->count();            
        }
        return $count > 0;
    }

    public function update($id,$attr) {

        if($this->checkEmail($attr['email'], $id)){
            return 'email_invalid';
        }

        $o = User::find($id);
        $attr['roles_id'] = self::ROLE;
        $password = $attr['password'];
        if(trim($password) != ''){
            $attr['password'] = Hash::make($password); 
        }else{
            unset($attr['password']); 
        }
        $o->fill($attr);
        return $o->save();
    }
    
    public function delete($id) {
        $o = User::find($id);
        $o->delete();
    }
}
