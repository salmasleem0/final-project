<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 
        return view('users.index', ['users' => $users]);
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'address' => 'required',
            'phone_num' => 'required|numeric',
            'user_type' => 'required|in:user,admin',
        ]);
    
        $userData = $request->all();
        $userData['password'] = Hash::make($request->password);
    
        User::create($userData);
        
        return redirect()->route('users.index');
    }
    public function show(string $id)
    {
        $users = User::findOrFail($id);
        return view('users.show', ['users' => $users]);
    }
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        return view('users.edit', ['users' => $users]);
    }
    public function update(Request $request, string $item)
{
    $user = User::findOrFail($item);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6',
        'address' => 'required',
        'phone_num' => 'required|numeric',
        'user_type' => 'required|in:user,admin',
    ]);

    $userData = [
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'phone_num' => $request->phone_num,
        'user_type' => $request->user_type,
    ];

    // Update password only if provided
    if ($request->filled('password')) {
        $userData['password'] = bcrypt($request->password);
    }

    $user->update($userData);

    return redirect()->back();
}

    public function destroy(string $id)
    {
        $users = User::findOrFail($id);

        $users->delete();

        return redirect()->route('users.index');

    }



}
