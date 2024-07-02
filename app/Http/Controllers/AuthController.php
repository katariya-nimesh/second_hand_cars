<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseHelper;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try{

            $request->validate([
                'phoneno' => 'required',
                'uid' => 'required',
                'fcm_token' => 'required',
                'user_type' => 'required'
            ]);

            $user = User::updateOrCreate(
                ['phoneno' => $request->phoneno],
                [
                    'uid' => $request->uid,
                    'fcm_token' => $request->fcm_token,
                    'user_type' => $request->user_type
                ]
            );

            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return ResponseHelper::success(['token' => $token, 'data' => $user]);
        }catch(\Exception $e){
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
