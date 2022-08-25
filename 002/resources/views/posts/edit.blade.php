@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                @endforeach
            @endif

            <form method="post" action="{{ route('posts.update', [ 'post' => $post->id ]) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">標題</label>
                    <input type="text"
                           name="title"
                           value="{{ old('title', $post->title)  }}"
                           placeholder="文章標題"
                           class="form-control"
                           id="title"
                           aria-describedby="title"
                           required autofocus>
                </div>

                <div class="form-group">
                    <label for="content">標題</label>
                    <textarea name="content"
                              placeholder="文章內容"
                              class="form-control"
                              id="content"
                              aria-describedby="content">{{ old('content', $post->content) }}</textarea>
                </div>

                <div class="form-group clearfix">
                    <button type="submit" class="btn btn-primary float-left">儲存</button>
                    <a href="{{ route('posts.index', [ session('pageName') => session('currentPage') ]) }}" class="btn btn-outline-secondary float-right">取消</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
