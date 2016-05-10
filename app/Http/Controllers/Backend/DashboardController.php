<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use App\User;
use App\Category;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function index()
    {

        $posts_count = Post::count();
        $users_count = User::count();
        $categories_count = Category::count();

        return response()->json([
            'flag' => true,
            'data' => [
                'posts_count' => $posts_count,
                'users_count' => $users_count,
                'categories_count' => $categories_count
            ]
        ]);
    }
}
