<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // to tell laravel use bootstrap in paginate not bootstrap
        Paginator::useBootstrapFive();

        // to change model path name FROM 'App\model\product' TO  'product'
        Relation::morphMap([
            'product'=>Product::class,
            'profile'=>Profile::class,
        ]);
    }
}