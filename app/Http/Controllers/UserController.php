<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $users = User::all();
        return view('users.create', compact('users'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required', 
            'email' => 'required',  
            'user_role' => 'required', 
        ];
        $messages = [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'user_role.required' => 'User Role is required.',
        ];
        $validatedData = $request->validate($rules, $messages);

        $user = new User();
        $user->name =  $request->name;
        $user->email =  $request->email;
        $user->role =  $request->user_role;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/User')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required', 
            'email' => 'required',  
            'user_role' => 'required', 
        ];
        $messages = [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'user_role.required' => 'User Role is required.',
        ];
        $validatedData = $request->validate($rules, $messages);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->user_role;
        $user->save();
        return redirect('/User')->with('success', 'User updated successfully!');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/User')->with('error', 'User deleted successfully!');
    }
}
