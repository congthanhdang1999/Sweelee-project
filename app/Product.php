<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'products';
    public function category() {
        return $this->belongsTo('App\CategoryProduct', 'category_product_id');
    }
    //parameters is foreign_key in dependent table s
    public function images() {
        return $this->hasMany('App\ProductImages', 'product_id');
    }
}
