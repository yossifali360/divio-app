@extends('layouts.app')

@section('content')
    <div class="col-12">
        <h1 class="p-3 border text-center my-3">Edit Post Info</h1>
    </div>
    <div class="col-8 mx-auto">
        <form action="{{ url('posts/' . $post->id) }}" method="POST" class="form border p-3">
            @method('PUT')
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->get('success') != null)
                <div class="alert alert-success">{{ session()->get('success') }}</div>
            @endif
            <div class="mb-3">
                <label for="">Post Title</label>
                <input type="text" class="form-control" value="{{ $post->title }}" name="title">
            </div>
            <div class="mb-3">
                <label for="">Post Description</label>
                <textarea class="form-control" name="description"rows="7">{{ $post->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="">Writer</label>
                <select name="user_id" class="form-control">
                    <option value="1">Yossif</option>
                    <option value="2">Ali</option>
                </select>
            </div>
            <div class="mb-3">
                <input type="submit" class="form-control" value="Save">
            </div>
        </form>
    </div>
@endsection
