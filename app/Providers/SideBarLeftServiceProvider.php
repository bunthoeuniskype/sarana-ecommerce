<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class SideBarLeftServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('site.layout.side_bar_left',function($view){
            $category_side_left = \App\Category::where(['status'=>1,'language_code'=>App::getLocale()])->orderBy('order','asc')->get(); 
            $ads_left = \App\Ads::where(['location'=>'Side_Left'])->orderBy('order','asc')->get();
            $view->with(compact('category_side_left','ads_left'));
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
