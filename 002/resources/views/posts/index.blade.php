@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>
                <a href="{{ route('posts.create') }}">新增文章</a>
            </p>

            @foreach($posts as $post)
                <p>
                    <a href="{{ route('posts.show', [ 'post' => $post->id ]) }}">{{ $post->title }}</a> |
                    <a href="{{ route('posts.edit', [ 'post' => $post->id ]) }}">修改</a> |
                    <a href="#delete" data-post-id="{{ $post->id }}">刪除</a>
                </p>
            @endforeach

            {{ $posts->links() }}

            <form method="post" action="" id="delete-form">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
        document.querySelectorAll('a[href="#delete"]').forEach(function(element) {
            element.addEventListener('click', function(event) {
                if(confirm(' 刪除事項？') == true) {
                    event.preventDefault();

                    const postId = event.target.dataset.postId;
                    const deleteForm = document.getElementById('delete-form');
                    deleteForm.action = '/posts/' + postId;
                    deleteForm.submit();
                }
            });
        });
@endsection
