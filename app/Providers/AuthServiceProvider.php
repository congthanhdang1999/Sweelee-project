<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
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
        //'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = Permission::all();
        foreach ($permissions as $permission) {


            Gate::define($permission->keycode, function (User $user) use ($permission) {
                return $user->hasPermission($permission->keycode);

            });

        }

        Gate::define('admin', function (User $user){
            return $user->hasRoles();
        });
        Gate::define('user-profile', function (User $user){
            return $user->isUserNotAdmin();
        });
    }
}
