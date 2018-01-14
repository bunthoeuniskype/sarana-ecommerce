<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use redirect;
use Auth;
class CheckoutMiddleware
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
            if (!Auth::guard('customer')->check()) {
            Session::put('oldUrl',$request->url());
             return redirect('customerlogin');
            }
         return $next($request);
      

    }
}
