@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <form method="post" action="{{ route('posts.update', [ 'post' => $post->id ]) }}">
                @csrf
                @method('PUT')
                <p>
                    <input type="text" name="title" value="{{ old('title', $post->title)  }}" placeholder="文章標題" required autofocus>
                </p>
                <p>
                    <textarea name="content" placeholder="文章內容">{{ old('content', $post->content) }}</textarea>
                </p>

                <p>
                    <button type="submit">儲存</button>
                    <a href="{{ route('posts.index', [ session('pageName') => session('currentPage') ]) }}">取消</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
