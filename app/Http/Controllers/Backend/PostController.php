<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

use App\Post;
use App\Category;

class PostController extends Controller
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
        $posts = Post::with('category')->forPage($current_page, $page_size)->get();
        $count = Post::count();
        return response()->json(['flag' => true, 'data' => $posts, 'count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return response()->json(['flag' => true, 'data' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category_id = $request->get('category_id', 0);
        $hasSelectedCategory = $category_id > 0;
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts',
            'content' => 'required'
        ], [
            'title.required' => '标题必填',
            'title.unique' => '标题不能重复',
            'content.required' => '内容必填'
        ]);
        if (!$category_id || $category_id == 0 || $category_id == '0') {
            $validator->errors()->add('category_id', '选择分类');
        }
        if ($validator->fails() || !$hasSelectedCategory) {
            if (!$hasSelectedCategory) {
                $validator->errors()->add('category_id', '选择分类');
            }
            return response()->json(['flag' => false, 'msg' => '验证未通过', 'errors' => $validator->errors()]);
        }

        if (Post::create($request->all())) {
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
        $post = Post::find($id);
        $categories = Category::all();
        if ($post) {
            return response()->json(['flag' => true, 'msg' => '数据获取成功', 'data' => $post, 'categories' => $categories]);
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
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['flag' => false, 'msg' => '修改失败']);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ], [
            'title.required' => '标题必填',
            'content.required' => '内容必填'
        ]);
        if ($validator->fails()) {
            return response()->json(['flag' => false, 'msg' => '验证未通过', 'errors' => $validator->errors()]);
        }

        if ($post->update($request->all())) {
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
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return response()->json(['flag' => true, 'msg' => '删除成功']);
        }
        return response()->json(['flag' => false, 'msg' => '删除失败']);
    }
}
