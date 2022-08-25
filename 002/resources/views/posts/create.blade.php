@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('posts.store') }}">
                @csrf
                <p>
                    <input type="text" name="title" placeholder="文章標題" required autofocus>
                </p>
                <p>
                    <textarea name="content" placeholder="文章內容"></textarea>
                </p>

                <p>
                    <button type="submit">儲存</button>
                    <a href="{{ route('posts.index') }}">取消</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
