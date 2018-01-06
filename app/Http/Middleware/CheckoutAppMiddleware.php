<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use redirect;
class CheckoutAppMiddleware
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
        if (!Session::has('customer')) {
            Session::put('oldUrl',$request->url());
             return redirect('customerlogin_app');
            }
         return $next($request);
      

    }
}
