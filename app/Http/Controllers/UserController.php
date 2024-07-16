<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseHelper;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    public function getUser()
    {
        return ResponseHelper::success(Auth::user());
    }

    public function getUserWalletBalance()
    {
        try {
            $user = Auth::user();

            // Attempt to find the user's wallet balance by user ID
            $walletBalance = UserWallet::where('user_id', $user->id)->first();

            // If wallet balance doesn't exist, create a new entry
            if (!$walletBalance) {
                $walletBalance = UserWallet::create([
                    'user_id' => $user->id,
                    'wallet_balance' => 0,
                ]);
            }

            return ResponseHelper::success($walletBalance, 'User data retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function updateUserProfile(Request $request){
        try {

            $user = Auth::user();

            $validatedData = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
                'phoneno' => 'sometimes|nullable|string|max:20',
                'business_name' => 'sometimes|required|string|max:255',
                'location' => 'sometimes|required|string|max:255',
            ]);

            // Update the user's profile details with only the validated fields
            $user->update($validatedData);

            // Redirect or return response
            return ResponseHelper::success($user, 'Car details updated successfully!');

        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

}
