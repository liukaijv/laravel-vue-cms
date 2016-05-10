<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AuthenticateOnceWithBasicAuth{
    /**
     * 处理输入请求.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return Auth::onceBasic() ?: $next($request);
    }

}