<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Helpers\ResponseHelper;

class WishlistController extends Controller
{
    // Add a car to the wishlist
    public function store(Request $request)
    {
        try{

            $request->validate([
                'car_details_id' => 'required|exists:car_details,id',
            ]);

            $user = Auth::user();

            // Check if the car is already in the wishlist
            if (Wishlist::where('user_id', $user->id)->where('car_details_id', $request->car_details_id)->exists()) {
                return ResponseHelper::error('Car is already in the wishlist', 400);
            }

            $wishlist = Wishlist::create([
                'user_id' => $user->id,
                'car_details_id' => $request->car_details_id,
            ]);

            return ResponseHelper::success($wishlist, 'Car added to wishlist successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    // Get all cars in the user's wishlist
    public function index(Request $request)
    {
        try{

            $user = Auth::user();
            $perPage = $request->input('per_page', 10);
            $wishlist = Wishlist::with(['car_detail', 'user'])->where('user_id', $user->id)->paginate($perPage);

            return ResponseHelper::success($wishlist, 'Wishlist retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    // Remove a car from the wishlist
    public function destroy($id)
    {
        try{

            $user = Auth::user();
            $wishlist = Wishlist::where('user_id', $user->id)->where('id', $id)->first();

            if (!$wishlist) {
                return ResponseHelper::error('Car not found in wishlist', 404);
            }

            $wishlist->delete();
            return ResponseHelper::success(null, 'Car removed from wishlist successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
