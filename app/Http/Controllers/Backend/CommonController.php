<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    // upload file
    public function upload(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['flag' => false, 'msg' => '文件为空']);
        }

        $file = $request->file('file');
        $path = $request->get('dir', '');
        if (!empty($path) && substr($path, 0, 1) != '/') {
            $path = '/' . $path;
        }

        if (!$file->isValid()) {
            return response()->json(['flag' => false, 'msg' => '文件上传出错']);
        }
        $new_filename = date('YmdHis') . uniqid() . '.' . $file->getClientOriginalExtension();
        $savePath = public_path($path);
        if (!file_exists($savePath)) {
            mkdir($savePath, 0755, true);
        }

        $file->move($savePath, $new_filename);
        return response()->json(['flag' => true, 'msg' => '文件上传成功', 'file' => $path . '/' . $new_filename]);

    }
}
