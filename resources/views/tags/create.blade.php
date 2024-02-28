@extends('layouts.app')

@section('content')
    <div class="col-12">
        <h1 class="my-3 text-center">Create New Tag</h1>
    </div>
    <div class="col-6 mx-auto">
        <form action="{{ route('tags.store') }}" method="POST" class="form border p-3">
            @csrf
            @include('inc.message')
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <input type="submit" value="Save" class="form-control bg-success text-white">
            </div>
        </form>
    </div>
@endsection
