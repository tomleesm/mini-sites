@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>
                <a href="{{ route('posts.create') }}" class="btn btn-primary">新增文章</a>
            </p>

            @foreach($posts as $post)
                <div class="clearfix m-1">
                    <a href="{{ route('posts.show', [ 'post' => $post->id ]) }}" class="float-left">{{ $post->title }}</a>
                    <a href="#delete" data-post-id="{{ $post->id }}" class="float-right ml-2 btn btn-outline-danger">刪除</a>
                    <a href="{{ route('posts.edit', [ 'post' => $post->id ]) }}" class="float-right ml-1 btn btn-outline-secondary">修改</a>
                </div>
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
