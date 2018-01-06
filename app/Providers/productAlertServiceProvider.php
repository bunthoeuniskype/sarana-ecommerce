<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class productAlertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.main.productAlert',function($view){

            $productAlert = DB::select('select * from product where qty <= qty_alert');  
            $alert=count($productAlert);             
            $view->with(compact('productAlert','alert'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
