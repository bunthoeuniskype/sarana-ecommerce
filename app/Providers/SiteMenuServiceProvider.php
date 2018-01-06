<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use App;
class SiteMenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('site.layout.menu_head',function($view){

            $category = \App\Category::where(['status'=>1,'language_code'=>App::getLocale()])->orderBy('order','asc')->get();  
                        
            $view->with(compact('category'));
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
