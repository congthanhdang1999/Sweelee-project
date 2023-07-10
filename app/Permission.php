<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $guarded = [];
    public function roleOfPermission(){
        return $this->belongstoMany('App\Role','role_permission','permission_id','role_id');
    }
}
