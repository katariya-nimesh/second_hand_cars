<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseHelper;
use App\Models\UserWallet;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;



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

            // Handle profile image upload
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($user->image) {
                    $oldImagePath = str_replace('/storage', 'public', $user->image);
                    Storage::delete($oldImagePath);
                }

                // Store the new image
                $path = $request->file('image')->store('public/profile_images');
                $user->image = Storage::url($path);
                $user->save();
            }
            // Redirect or return response
            return ResponseHelper::success($user, 'Car details updated successfully!');

        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function addTransactionDetails(Request $request){
        //
    }

    public function getVendorProfile($id){
        try {
            // Find the vendor by ID
            $vendor = User::with('car_detail')->where('user_type', 'vendor')->where('id', $id)->first();

            // Check if the vendor exists
            if (!$vendor) {
                return ResponseHelper::error('Vendor not found', 404);
            }

            // Return the vendor profile
            return ResponseHelper::success($vendor, 'Vendor profile retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
