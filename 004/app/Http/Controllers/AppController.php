<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function __invoke(Request $request)
    {
        $messages = DB::table('messages')
                        ->join('users', 'messages.user_id', '=', 'users.id')
                        ->select('users.name', 'messages.content')
                        ->orderBy('messages.created_at', 'asc')
                        ->get();

        return view('app', [
            'user' => $request->user(),
            'messages' => $messages
        ]);
    }
}
