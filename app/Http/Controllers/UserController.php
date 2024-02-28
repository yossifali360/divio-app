<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'max:30'],
            'confirm_password' => ['required', 'string', 'min:6', 'max:30', 'same:password'],
            'type' => ['required', 'in:admin,writer']
        ]);

        User::create($data);
        return back()->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function posts(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.posts', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findorFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findorFail($id);
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:6', 'max:30'],
            'confirm_password' => ['nullable', 'string', 'min:6', 'max:30', 'same:password'],
            'type' => ['required', 'in:admin,writer']
        ]);
        $data['password'] = $request->has('password') ? bcrypt($request->password) : $user->password;
        unset($data['confirm_password']);
        User::where('id', $id)->update($data);
        return redirect()->route('users.index')->with('success', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findorFail($id);
        $user->delete();
        return back()->with('success', 'User Deleted Successfully');
    }
}
