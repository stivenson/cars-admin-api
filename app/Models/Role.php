<?php namespace Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    /**
     * Generated
     */

    protected $table = 'roles';
    protected $fillable = ['name'];


    public function users() {
        return $this->hasMany(Model\User::class, 'roles_id', 'id');
    }


}
