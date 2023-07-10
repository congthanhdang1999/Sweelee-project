<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProduct extends Model
{


    protected $table = 'category_products';
    protected $fillable = ['name', 'slug', 'parent_id'];
    public function catProductChild() {
        return $this->hasMany('App\CategoryProduct', 'parent_id');
    }
    public function catProductParent() {
        return $this->belongsTo('App\CategoryProduct', 'parent_id');
    }
    public function productChild(){
        return $this->hasMany('App\Product', 'category_product_id');
    }
    public function productParent(){
        return $this->hasManyThrough(Product::class, CategoryProduct::class, 'parent_id', 'category_product_id', 'id');
    }


}
