<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('app', [
          'user' => $request->user()
        ]);
    }
}
