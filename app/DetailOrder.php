<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $table = "detail_orders";
    protected $guarded = [];
    public function customer() {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
    public function order() {
        return $this->belongsTo('App\Order', 'order_id');
    }
}
