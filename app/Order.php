<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $guarded = [];

    public function users() {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function orderDetails() {
        return $this->hasMany('App\DetailOrder', 'order_id');
    }

}
