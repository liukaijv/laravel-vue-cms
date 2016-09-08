<?php

namespace App\Http\Middleware;

use Closure;

class CrossDomain
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
        $response =  $next($request);
        $response->header('Access-Control-Allow-Origin','*');
        // $response->header('Access-Control-Allow-Methods','POST, PUT,PATCH DELETE, GET, OPTIONS');
        return $response;
    }
}
