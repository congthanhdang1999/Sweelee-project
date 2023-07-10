<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
//        Gate::define('role.add', function (User $user) {
//            //return $user->hasPermission($permission->keycode);
//            return true;
//        });
//        Gate::define('role.add', function ($user) {
//            return $user->isAdmin;
//        });
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            //lặp list per lấy ra từng permission-con
            //gate('tên cổng là tên permission'),function (User) use (quyền con)
            //trả về true nếu user có quyền con

            Gate::define($permission->keycode, function (User $user) use ($permission) {
                return $user->hasPermission($permission->keycode);

            });
        }

    }
}
