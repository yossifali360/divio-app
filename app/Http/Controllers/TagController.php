<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate();
        return view('tags.index', compact('tags'));
    }
    public function show($id)
    {
        //
    }
    public function home()
    {
        //
    }
    public function create()
    {
        return view('tags.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3',
        ]);
        Tag::create($data);
        return back()->with('success', 'User created successfully');
    }
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|min:3',
        ]);

        $tag->update(['name' => $request->name]);
        $tag->save();
        return redirect()->route('tags.index')->with('success', 'Tag Updated Successfully');
    }
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back()->with('success', 'Tag Deleted Successfully');
    }
    public function search(Request $request)
    {
        //
    }
}
