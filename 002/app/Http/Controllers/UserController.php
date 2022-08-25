<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->select('id', 'name')->get();
        return view('users.index', [ 'users' => $users ]);
    }

    public function posts($userId)
    {
        $posts = DB::table('posts')->where('user_id', $userId)->select('id', 'title')->get();
        $user = DB::table('users')->where('id', $userId)->select('id', 'name')->first();

        return view('users.posts',
            [
                'posts' => $posts,
                'user' => $user,
            ]);
    }
}
