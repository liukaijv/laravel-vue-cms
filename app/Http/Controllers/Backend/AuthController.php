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

    protected $username = 'name';

    public function postLogin(Request $request)
    {

        $result = ['flag' => false, 'msg' => '登陆失败，账户和密码不企配'];
        $result = ['flag' => false, 'msg' => '登陆失败'];
        $credentials = $request->only('name', 'password');
        if (str_contains($credentials['name'], '@')) {
            $credentials['email'] = $credentials['name'];
            unset($credentials['name']);
        }
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
