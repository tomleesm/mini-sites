
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

            <form method="post" action="{{ route('posts.destroy', [ 'post' => $post->id ]) }}" id="delete-form">
                @csrf
                @method('DELETE')
            </form>

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

@section('javascript')
        document.querySelector('a[href="#delete"]').addEventListener('click', function() {
            if(confirm(' 刪除事項？') == true) {
                event.preventDefault();

                document.getElementById('delete-form').submit();
            }
        });
@endsection
