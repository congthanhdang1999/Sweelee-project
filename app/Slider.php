<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';
    protected $guarded = [];
    function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
