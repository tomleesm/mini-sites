@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>
                <a href="{{ route('users.posts.index', [ 'user' => $user->id ]) }}">回到 {{ $user->name }} 的文章清單</a>
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
