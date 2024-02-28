@extends('layouts.app')

@section('content')
{{-- @dd($posts) --}}
    <div class="col-12">
        <h1 class="p-3 border text-center my-3">All Posts</h1>
    </div>
    <div class="col-8 mx-auto">
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-header">
                    {{ ucwords($post->user->name) }} - {{ $post->created_at->format('Y-m-d') }}
                </div>
                <div class="card-body">
                    <div class="cardImg">
                        <img src="{{$post->image()}}" class="w-100 rounded-2 mb-2" height="400" alt="post image">
                    </div>
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->description, 200) }}</p>
                    <a href="{{ url('posts/' . $post->id) }}" class="btn btn-primary">Show Post</a>
                </div>
            </div>
        @endforeach
    </div>
    <div>
        {{ $posts->links() }}
    </div>
@endsection
