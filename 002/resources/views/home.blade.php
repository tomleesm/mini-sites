@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('posts.create') }}">新增文章</a>
        </div>
    </div>
</div>
@endsection
