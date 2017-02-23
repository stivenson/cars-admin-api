<?php namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {

    /**
     * Generated
     */

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'orders';
    protected $fillable = ['delivery_type', 'status', 'users_id'];

    public function user() {
        return $this->belongsTo(Model\User::class, 'users_id', 'id');
    }

    public function products() {
        return $this->belongsToMany(Model\Product::class, 'items_orders', 'orders_id', 'products_id');
    }

    public function itemsOrders() {
        return $this->hasMany(Model\ItemsOrder::class, 'orders_id', 'id');
    }


}
