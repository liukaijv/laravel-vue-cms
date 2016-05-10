<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Cache;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Admin;

class AuthController extends Controller
{

    public function postLogin(Request $request)
    {
        $result = ['flag' => false, 'msg' => '登陆失败'];
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $token = uniqid();
            $id = Auth::guard('admin')->id();
            if (Admin::where(['id' => $id])->update(['login_token' => $token])) {
                $result = ['flag' => true, 'msg' => "登陆成功", 'jwt_token' => $token, 'data' => Auth::guard('admin')->user()];
            }
        }
        return response()->json($result);
    }

    public function postLogout()
    {

        $id = Auth::guard('admin')->id();
        Auth::guard('admin')->logout();
        Admin::where(['id' => $id])->update(['login_token' => null]);
        Cache::forget('login_admin');
        return response()->json(['flag' => true]);

    }

}
