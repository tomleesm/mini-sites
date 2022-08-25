
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <p><a href="{{ route('posts.index') }}">回到文章清單</a></p>

            <p>
                <a href="{{ route('posts.edit', [ 'post' => $post->id ]) }}">修改</a> |
                <a href="#delete">刪除</a>
            </p>

            <h1>{{ $post->title }}</h1>
            <article>
                {{ $post->content }}
            </article>
            <p>新增文章時間：{{ $post->created_at }}</p>
            <p>修改文章時間：{{ $post->updated_at }}</p>
        </div>
    </div>
</div>
@endsection
