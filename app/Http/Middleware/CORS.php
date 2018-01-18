<?php

namespace App\Http\Middleware;

use Closure;

class CORS
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
        header('Access-Control-Allow-Origin: *');       

        $headers = [
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
        ];

        if($request->getMethod() == "OPTIONS") {
            return Response::make('OK', 200, $headers);
        }        

        $response = $next($request);
            foreach($headers as $key => $value)
                $response->header($key, $value);
            return $response;        
/*
          $response = $next($request);
        // We only want the headers set for the api requests
        if ($request->segment(1) == 'apis') {
            // Set the default headers for cors If you only want this for OPTION method put this in the if below
            $response->headers->set('Access-Control-Allow-Origin','*');
            $response->headers->set('Access-Control-Allow-Headers','Content-Type,X-Amz-Date,Authorization,X-Api-Key,X-Amz-Security-Token,X-XSRF-TOKEN,Access-Control-Allow-Headers');
            $response->headers->set('Access-Control-Allow-Methods','POST, GET, OPTIONS, PUT, DELETE');
            // Set the allowed methods for the specific uri if the request method is OPTION
            if ($request->isMethod('options')) {                
                $response->headers->set(
                    'Access-Control-Allow-Methods',
                    $response->headers->get('Allow')
                );
            }
        }
        return $response;*/
    }
}
