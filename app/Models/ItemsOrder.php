<?php namespace Models;

use Illuminate\Database\Eloquent\Model;

class ItemsOrder extends Model {

    /**
     * Generated
     */

    protected $table = 'items_orders';
    protected $fillable = ['products_id', 'amount', 'observations', 'orders_id'];


    public function order() {
        return $this->belongsTo(Models\Order::class, 'orders_id', 'id');
    }

    public function product() {
        return $this->belongsTo(Models\Product::class, 'products_id', 'id');
    }


}
