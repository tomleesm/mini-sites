@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <ul>
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endif
            </ul>

            <p>
                <a href="{{ route('posts.create') }}">新增文章</a>
            </p>

            @foreach($posts as $post)
                <p>
                    {{ $post->title }} |
                    <a href="{{ route('posts.edit', [ 'post' => $post->id ]) }}">修改</a> |
                    <a href="#delete">刪除</a>
                </p>
            @endforeach
            <p> </p>
        </div>
    </div>
</div>
@endsection
