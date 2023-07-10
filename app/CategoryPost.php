<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryPost extends Model
{
    use SoftDeletes;
    protected $table = 'category_posts';
    protected $fillable = ['name', 'slug'];
    public function posts() {
        return $this->hasMany('App\Post', 'category_post_id');
    }
}
