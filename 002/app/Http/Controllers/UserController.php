<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    const PER_PAGE = 10;

    public function index(Request $request)
    {
        $users = DB::table('users')->select('id', 'name', 'email')->paginate(self::PER_PAGE);

        $request->session()->put('usersCurrentPage', $users->currentPage());
        $request->session()->put('pageName', $users->getPageName());

        return view('users.index', [ 'users' => $users ]);
    }

    public function posts(Request $request, $userId)
    {
        $posts = DB::table('posts')->where('user_id', $userId)->select('id', 'title')->paginate(self::PER_PAGE);
        $user = DB::table('users')->where('id', $userId)->select('id', 'name')->first();

        $request->session()->put('postsCurrentPage', $posts->currentPage());
        $request->session()->put('pageName', $posts->getPageName());

        return view('users.posts',
            [
                'posts' => $posts,
                'user' => $user
            ]);
    }

    public function post($userId, $postId)
    {
        $post = DB::table('posts')->where('id', $postId)->first();
        $user = DB::table('users')->where('id', $userId)->select('id', 'name')->first();

        return view('users.post',
            [
                'post' => $post,
                'user' => $user
            ]);
    }
}
