<?php

namespace App\Http\Middleware;
use App;
use Closure;
use Session;
use Illuminate\Support\Facades\Input;
use Redirect;
use Config;
class LanguagesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //App::setLocale(DB::table('settings')->where('id', 1)->first()->languange);
        // dd(session()->get('locale'));
        
       if(Session::has('locale')){
            App::setLocale(Session::get('locale'));
        }else{
          App::setLocale(Config::get('app.locale'));
        }
        return $next($request);

    }
}
