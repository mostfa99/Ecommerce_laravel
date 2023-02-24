<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

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
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        /*
            Gate::define('name of permission',function{
                // ...
            });

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
                        $user->hasAbility($key);
            });
        }*/
    }
}
