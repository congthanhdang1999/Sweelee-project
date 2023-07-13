<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $guarded = [];
    protected $table = 'informations';
    public function user(){
        return $this->belongsto('App\User','user_id');
    }
}
