<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'phoneno' => 'required|max:20'
        ]);

        $user = User::create([
            'phoneno' => $request->phoneno
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'phoneno' => 'required',
        ]);

        $user = User::where('phoneno', $request->phoneno)->first();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }
}
