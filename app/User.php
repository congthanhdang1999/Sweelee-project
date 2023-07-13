<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{

    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongstoMany('App\Role', 'user_role', 'user_id', 'role_id');
    }

    public function information()
    {
        return $this->hasOne('App\Information');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->where('keycode', $permission)->count() > 0) {
                return true;
            };
        }
        return false;
    }
    public function hasRoles()
    {
        if($this->roles->count() > 0 ){
            return true;
        }
        return false;
    }
    public function isUserNotAdmin()
    {
        if($this->roles->count() == 0 ){
            return true;
        }
        return false;
    }
}
