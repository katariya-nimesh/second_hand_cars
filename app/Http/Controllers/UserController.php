<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseHelper;
use App\Models\UserWallet;
use App\Models\User;
use App\Models\UserQR;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{
    public function getUser()
    {
        return ResponseHelper::success(Auth::user()->load('plan'));
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
                'year_of_establishment' => 'sometimes|nullable|integer',
                'gst_number' => 'sometimes|nullable|string|max:15',
                'address' => 'sometimes|nullable|string|max:255',
                'city' => 'sometimes|nullable|string|max:100',
                'state' => 'sometimes|nullable|string|max:100',
                'pincode' => 'sometimes|nullable|string|max:10',
                'business_email' => 'sometimes|nullable|email|max:255',
                'type_of_business' => 'sometimes|nullable|string|max:100',
                'name_of_partner_1' => 'sometimes|nullable|string|max:255',
                'name_of_partner_2' => 'sometimes|nullable|string|max:255',
                'phoneno_2' => 'sometimes|nullable|string|max:20',
            ]);

            // Update the user's profile details with only the validated fields
            $user->update($validatedData);

            // Handle file uploads
            $fileFields = [
                'vendor_live_photo',
                'business_live_photo',
                'gst_certificate',
                'partnersheep_deed',
                'adharcard_one',
                'adharcard_two',
                'cancel_cheque'
            ];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    // Delete the old file if it exists
                    if ($user->$field) {
                        $oldFilePath = str_replace('/storage', 'public', $user->$field);
                        Storage::delete($oldFilePath);
                    }

                    // Store the new file
                    $path = $request->file($field)->store("public/{$field}");
                    $user->$field = Storage::url($path);
                }
            }

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
            }

            // Save user after all updates
            $user->save();

            // Redirect or return response
            return ResponseHelper::success($user, 'Profile updated successfully!');

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

    public function getAllVendor(){
        try {
            // Find the vendor by ID
            $vendor = User::where('user_type', 'vendor')->get();

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

    public function getAllVendorLocation()
    {
        try {
            // Get unique locations for vendors
            $locations = User::where('user_type', 'vendor')
                ->whereNotNull('location')
                ->distinct()
                ->pluck('location');

            // Check if any locations were found
            if ($locations->isEmpty()) {
                return ResponseHelper::error('No vendor locations found', 404);
            }

            // Return the unique locations
            return ResponseHelper::success($locations, 'Vendor locations retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function vendorProfileWebPage($id){
        try {
            // Find the vendor by ID
            $vendor = User::where('user_type', 'vendor')->where('id', $id)->first();

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

    public function storeUserQr(Request $request)
    {
        try{

            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'qr_image' => 'required|image|max:2048' // Validate the uploaded file
            ]);

            if ($validator->fails()) {
                return ResponseHelper::error($validator->errors(), 400);
            }

            $path = $request->file('qr_image')->store('public/qr_images');

            $userQR = UserQR::create([
                'user_id' => $request->user_id,
                'qr_image' => Storage::url($path)
            ]);

            return ResponseHelper::success($userQR, 'QR user store successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
