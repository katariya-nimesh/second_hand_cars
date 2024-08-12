<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'location' => 'required',
            'phoneno' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'phoneno' => $request->phoneno,
            'user_type' => "user",
            'uid' => "xyz",
            'fcm_token' => "xyz"
        ]);

        return redirect()->route('manage-users')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function details($id)
    {
        $user = User::find($id);
        return view('admin.users.details', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $request->id,
            'location' => 'required',
            'phoneno' => 'required'
        ]);

        $users = User::find($request->id);
        $users->fill($request->all());

        $users->save();

        return redirect()->route('manage-users')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();

        return redirect()->route('manage-users')->with('success', 'User deleted successfully.');
    }

    public function changeStatus(Request $request){
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->update();

        return response()->json(["message" => "Status updated successfully !"]);
    }
}

