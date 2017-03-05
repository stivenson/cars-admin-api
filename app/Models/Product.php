<?php namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'value', 'iva', 'available', 'image1', 'mime'];


    public function orders() {
        return $this->belongsToMany(Model\Order::class, 'items_orders', 'products_id', 'orders_id');
    }

    public function itemsOrders() {
        return $this->hasMany(Model\ItemsOrder::class, 'products_id', 'id');
    }


}
