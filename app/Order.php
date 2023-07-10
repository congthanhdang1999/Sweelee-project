<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function orderDetails() {
        return $this->hasMany('App\DetailOrder', 'order_id');
    }

}
