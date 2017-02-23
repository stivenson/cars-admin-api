<?php namespace Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'roles_id', 'cell_phone', 'telephone', 'cc', 'address', 'neighborhood'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function role() {
        return $this->belongsTo(Model\Role::class, 'roles_id', 'id');
    }

    public function orders() {
        return $this->hasMany(Model\Order::class, 'users_id', 'id');
    }

}

