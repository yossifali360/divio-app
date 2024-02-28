@extends('layouts.app')

@section('content')
    <div class="col-12">
        <h1 class="my-3 text-center">Create New User</h1>
    </div>
    <div class="col-6 mx-auto">
        <form action="{{ route('users.store') }}" method="POST" class="form border p-3">
            @csrf
            @include('inc.message')
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="type">Type</label>
                <select name="type" class="form-control" id="">
                    <option value="admin">Admin</option>
                    <option value="writer">Writer</option>
                </select>
            </div>
            <div class="mb-3">
                <input type="submit" value="Save" class="form-control bg-success text-white">
            </div>
        </form>
    </div>
@endsection
