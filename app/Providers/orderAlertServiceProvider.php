<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use App\Orders;
class orderAlertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.main.orderAlert',function($view){

            $orderAlert = Orders::where('check_status',0)->orderBy('id','desc')->get(); 
            $orderAlert->transform(function($order,$key)
            {
                $order->cart = unserialize($order->cart);
                return $order;
            }); 

            $alert=count($orderAlert);  
           
            $view->with(compact('orderAlert','alert'));
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
