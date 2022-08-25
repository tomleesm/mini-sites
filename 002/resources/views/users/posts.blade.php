@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ $user->name }} 的文章清單</h1>
            @foreach($posts as $post)
                <p>
                    <a href="{{ route('users.posts.show', [ 'user' => $user->id, 'post' => $post->id ]) }}">{{ $post->title }}</a>
                </p>
            @endforeach

            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
