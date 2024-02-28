<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate();
        return view('posts.index', ['posts' => $posts]);
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }
    public function home()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate();
        return view('home', ['posts' => $posts]);
    }
    public function create()
    {
        $users = User::select('id', 'name')->get();
        return view('posts.add', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3'],
            'description' => ['required', 'string', 'max:1500'],
            'user_id' => ['required', 'exists:users,id'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg,gif'],
        ]);
        $image = $request->file('image')->store('public');
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        $post->image = $image;
        $post->save();
        return back()->with('success', 'Post Added successfully');
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }
    public function update($id, Request $request)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        $post->save();
        return redirect('posts')->with('success', 'Post Updated successfully');
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return back()->with('success', 'Post Deleted Successfully');
    }
    public function search(Request $request)
    {
        $posts = Post::where('description', 'LIKE', '%' . $request->q . '%')->paginate();
        return view('posts.search', ['posts' => $posts]);
    }
}
