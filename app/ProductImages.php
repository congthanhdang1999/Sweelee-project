<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table = 'product_images';
    protected $guarded = [];


    // product -> Model: product
    public function product() {
        return $this->belongsTo('App\Product','product_id','id');
    }
}
