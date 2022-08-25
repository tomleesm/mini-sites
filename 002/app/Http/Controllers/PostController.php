<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    // 分頁每一頁有幾筆
    const PER_PAGE = 10;

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = DB::table('posts')->where('user_id', $request->user()->id)->paginate(self::PER_PAGE);
        $request->session()->put('currentPage', $posts->currentPage());
        $request->session()->put('pageName', $posts->getPageName());

        return view('posts.index', [ 'posts' => $posts ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();
            $id = DB::table('posts')->insertGetId([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'user_id' => $request->user()->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            $message = sprintf('%s, line: %d, message: %s',
                               __FILE__,
                               __LINE__,
                               $e->getMessage());
            # 通常在 storage/logs/laravel.log
            Log::error($message);
        }

        return redirect()->route('posts.show', [ 'post' => $id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        return view('posts.show',
            [
                'post' => $post
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        return view('posts.edit',
            [
                'post' => $post
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();
            DB::table('posts')->where('id', $id)
                              ->update([
                                'title' => $request->input('title'),
                                'content' => $request->input('content'),
                                'updated_at' => now()
                              ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            $message = sprintf('%s, line: %d, message: %s',
                               __FILE__,
                               __LINE__,
                               $e->getMessage());
            # 通常在 storage/logs/laravel.log
            Log::error($message);
        }

        return redirect()->route('posts.show', [ 'post' => $id ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            DB::table('posts')->where('id', $id)->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            $message = sprintf('%s, line: %d, message: %s',
                               __FILE__,
                               __LINE__,
                               $e->getMessage());
            # 通常在 storage/logs/laravel.log
            Log::error($message);
        }

        // 刪除後的最後一頁不等於currentPage，則 currentPage 減掉 1
        // 刪除後的總筆數除以每一頁的筆筆，餘數爲 0
        $currentPage = session('currentPage');
        if ( ( DB::table('posts')->count() % self::PER_PAGE ) === 0 ) {
            $currentPage--;
            session([ 'currentPage' => $currentPage ]);
        }

        return redirect()->route('posts.index', [
            session('pageName') => $currentPage
        ]);
    }
}
