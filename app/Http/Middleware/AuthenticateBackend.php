<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
use Illuminate\Support\Str;
use App\Admin;

class AuthenticateBackend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization', '');
        if (Str::startsWith($token, 'Bearer ')) {
            $token = Str::substr($token, 7);
        }
        if (empty($token)) {
            $token = $request->input('jwt_token', '');
        }
        if (empty($token)) {
            return response()->json(['flag' => false, 'msg' => '没有权限请先登陆']);
        }

        $admin = Cache::rememberForever('login_admin', function () use ($token) {
            return Admin::where(['login_token' => $token])->first();
        });

        if ($admin == null) {
            return response()->json(['flag' => false, 'msg' => '没有权限请先登陆']);
        }
        $response = $next($request);

        if ($admin->login_token != null) {
            $response->header('Authorization', $admin->login_token);
        }

        return $response;
    }
}
