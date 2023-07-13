<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $table = "detail_orders";
    protected $guarded = [];

    public function order() {
        return $this->belongsTo('App\Order', 'order_id');
    }
    public function products() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
