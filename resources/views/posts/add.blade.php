@extends('layouts.app')

@section('content')
    <div class="col-12">
        <h1 class="p-3 border text-center my-3">Add Post</h1>
    </div>
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
    <div class="col-8 mx-auto">
        <form action="{{ url('posts') }}" method="POST" class="form border p-3" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="">Post Title</label>
                <input type="text" class="form-control" value="{{ old('title') }}" name="title">
            </div>
            <div class="mb-3">
                <label for="">Post Description</label>
                <textarea class="form-control" name="description" rows="7">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="">Post Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Writer</label>
                <select name="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <input type="submit" class="form-control btn btn-primary" value="Save">
            </div>
        </form>
    </div>
@endsection
