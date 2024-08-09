<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // dd("herer");
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if ($credentials['username'] === 'admin' && $credentials['password'] === 'Admin@123') {
            // Login successful, redirect to dashboard
            session(['logged_in' => true]);
            return redirect()->route('dashboard');
        }

        // Login failed, redirect back with error
        return back()->withErrors([
            'message' => 'Invalid credentials.',
        ]);
    }

    public function logout()
    {
        session()->forget('logged_in');
        return redirect()->route('login');
    }
}
