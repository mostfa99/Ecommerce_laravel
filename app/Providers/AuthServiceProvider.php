<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

            /*
            Gate::define('name of permission',function{
                // ...
            });
            */
        Gate::before(function($user, $ability) {
            if($user =='super-admin'){
                return true ;
            }
            if($user =='user'){
                return false  ;
            }
        });

        foreach (config('abilities') as $key => $value){
                    Gate::define($key , function($user) use ($key,$value) {
                        $roles =Role::whereRaw('roles.id IN (SELECT role_id FROM role_user WHERE user_id = ? )', [
                            $user->id ,
                        ])->get();
                            // SELECT * FROM roles WHERE id IN(SELECT role_id FROM role_user WHERE user_id =? )
                            //SELECT * FROM roles INNER JOIN role_user ON roles.id = role_user.role_id WHERE role_id.user_id = ?
                        foreach ($roles as $role) {
                            if(in_array($key , $role->abilities)){
                                return true;
                            }
                        }
                return false ;
            });
        }
    }
}