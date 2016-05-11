<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Validator;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $current_page = $request->input('page', 1);
        $page_size = $request->input('page_size', 15);
        $users = User::forPage($current_page, $page_size)->get();
        $count = User::count();
        return response()->json(['flag' => true, 'data' => $users, 'count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:admins',
            'password' => 'required|same:repeat_password',
            'repeat_password' => 'required'
        ], [
            'email.required' => '邮箱必填',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '邮箱已存在',
            'password.required' => '密码必填',
            'password.same' => '两次密码不一致',
            'repeat_password.required' => '密码确认必填'
        ]);

        if ($validator->fails()) {
            return response()->json(['flag' => false, 'msg' => '验证未通过', 'errors' => $validator->errors()]);
        }

        $request->password = Hash::make($request->password);
        if (User::create($request->all())) {
            return response()->json(['flag' => true, 'msg' => '添加成功']);
        }

        return response()->json(['flag' => false, 'msg' => '添加失败']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json(['flag' => true, 'msg' => '数据获取成功', 'data' => $user]);
        }
        return response()->json(['flag' => false, 'msg' => '数据获取失败']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['flag' => false, 'msg' => '修改失败']);
        }
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ], [
            'email.required' => '邮箱必填',
            'email.email' => '邮箱格式不正确'
        ]);
        if ($validator->fails()) {
            return response()->json(['flag' => false, 'msg' => '验证未通过', 'errors' => $validator->errors()]);
        }
        $data = [];
        $password = $request->get('password', '');
        $new_password = $request->get('new_password', '');
        if ($password && $new_password) {
            if (!Hash::check($password, $user->password)) {
                return response()->json(['flag' => false, 'msg' => '原始密码不正确']);
            }
            $data['password'] = Hash::make($new_password);
        }
        $data = array_merge($data, $request->only('name', 'email', 'image'));
        $user->update($data);
        return response()->json(['flag' => true, 'msg' => '修改成功', 'data' => $user]);

        return response()->json(['flag' => false, 'msg' => '修改失败']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
