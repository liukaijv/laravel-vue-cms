<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tag;
use Validator;

class TagController extends Controller
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
        $tags = Tag::latest()->forPage($current_page, $page_size)->get();
        $count = Tag::count();
        return response()->json(['flag' => true, 'data' => $tags, 'count' => $count]);
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
            'name' => 'required'
        ], [
            'name.required' => '名称必填'
        ]);

        if ($validator->fails()) {
            return response()->json(['flag' => false, 'msg' => '验证未通过', 'errors' => $validator->errors()]);
        }

        if (Tag::create($request->all())) {
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
        $tag = Tag::find($id);
        if ($tag) {
            return response()->json(['flag' => true, 'msg' => '数据获取成功', 'data' => $tag]);
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
        $tag = Tag::find($id);
        if (!$tag) {
            return response()->json(['flag' => false, 'msg' => '修改失败']);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ], [
            'name.required' => '名称必填'
        ]);

        if ($validator->fails()) {
            return response()->json(['flag' => false, 'msg' => '验证未通过', 'errors' => $validator->errors()]);
        }

        if ($tag->update($request->all())) {
            return response()->json(['flag' => true, 'msg' => '修改成功']);
        }

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
        $tag = Tag::find($id);
        if ($tag) {
            $tag->delete();
            return response()->json(['flag' => true, 'msg' => '删除成功']);
        }
        return response()->json(['flag' => false, 'msg' => '删除失败']);
    }
}
