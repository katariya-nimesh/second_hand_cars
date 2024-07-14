<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\CarBrand;
use App\Models\CarRegistrationYear;
use App\Models\CarVariant;
use App\Models\CarFuelType;
use App\Models\CarFuelVariant;
use App\Models\CarVariantType;
use App\Models\CarOwner;
use App\Models\CarKilometer;
use App\Models\CarDetail;
use App\Models\CarImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class CarController extends Controller
{
    public function getCarBrands()
    {
        try{
            $carBrands = CarBrand::all();
            return ResponseHelper::success($carBrands);
        }catch(\Exception $e){
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function getRegistrationYearsByBrandId($brandId)
    {
        try {
            $years = CarRegistrationYear::where('car_brand_id', $brandId)->get();

            if ($years->isEmpty()) {
                return ResponseHelper::error('No registration years found for the given brand ID', 404);
            }

            return ResponseHelper::success($years, 'Registration years retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function getCarVarientByRegistrationYearId($registrationYearId)
    {
        try {
            $carVarient = CarVariant::where('car_registration_year_id', $registrationYearId)->get();

            if ($carVarient->isEmpty()) {
                return ResponseHelper::error('No car varient on this given car registration year id', 404);
            }

            return ResponseHelper::success($carVarient, 'Car Varient retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function getCarFuelTypeByVarientId($varientId)
    {
        try {
            $carFuelType = CarFuelType::where('car_varient_id', $varientId)->get();

            if ($carFuelType->isEmpty()) {
                return ResponseHelper::error('No car fuel type on this given car varient id', 404);
            }

            return ResponseHelper::success($carFuelType, 'Car Fuel Type retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }


    public function getCarFuelVarientByCarFuelTypeId($carFuelTypeId)
    {
        try {
            $carfuelVarient = CarFuelVariant::where('car_fuel_type_id', $carFuelTypeId)->get();

            if ($carfuelVarient->isEmpty()) {
                return ResponseHelper::error('No car fuel varient on this given car fuel type id', 404);
            }

            return ResponseHelper::success($carfuelVarient, 'Car Fuel Varient retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function getCarVarientTypeByCarFuelVarientId($carFuelVarientId)
    {
        try {
            $carVarientType = CarVariantType::where('car_fuel_varient_id', $carFuelVarientId)->get();

            if ($carVarientType->isEmpty()) {
                return ResponseHelper::error('No car varient type on this given car fuel varient id', 404);
            }

            return ResponseHelper::success($carVarientType, 'Car Varient Type retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function getCarOwners()
    {
        try {
            $carOwners = CarOwner::all();

            if ($carOwners->isEmpty()) {
                return ResponseHelper::error('No car owners', 404);
            }

            return ResponseHelper::success($carOwners, 'Car owners retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function getCarKilometers()
    {
        try {
            $carKilometers = CarKilometer::orderBy('start_km', 'asc')->get();

            if ($carKilometers->isEmpty()) {
                return ResponseHelper::error('No car kilometers', 404);
            }

            return ResponseHelper::success($carKilometers, 'Car kilometers retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function addCarDetails(Request $request) {
        try {
            // Validation rules
            $rules = [
                'car_varient_type_id' => 'required',
                'car_owner_id' => 'required',
                'car_kilometer_id' => 'required',
                'price' => 'required',
                'accident' => 'required',
                'status' => 'required'
            ];

            // Validate the request
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return ResponseHelper::validationError($validator->errors());
            }
            $user = Auth::user();
            // Add car details
            $carDetails = CarDetail::create([
                'user_id' => $user->id,
                'car_varient_type_id' => $request->car_varient_type_id,
                'car_owner_id' => $request->car_owner_id,
                'car_kilometer_id' => $request->car_kilometer_id,
                'price' => $request->price,
                'accident' => $request->accident,
                'status' => $request->status,
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate images
                'videos.*' => 'mimes:mp4,mov,ogg,qt|max:20000' // Validate videos
            ]);

            // Handle images upload
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('public/images');
                    CarImage::create([
                        'car_varient_type_id' => $request->car_varient_type_id,
                        'image' => Storage::url($path),
                        'type' => 'image'
                    ]);
                }
            }

            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $video) {
                    $path = $video->store('public/videos');
                    CarImage::create([
                        'car_varient_type_id' => $request->car_varient_type_id,
                        'image' => Storage::url($path),
                        'type' => 'video'
                    ]);
                }
            }

            // Return a response
            return ResponseHelper::success($carDetails, 'Car Details Add successfully');

        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function getUserCarDetails(){
        try {
            $user = Auth::user();

            $carDetails = CarDetail::with(['car_varient_type.car_images','car_varient_type.car_fuel_varient.car_fuel_type.car_varient.car_registration_year.car_brand', 'car_owner', 'car_kilometer'])->where('user_id', $user->id)->get();

            if ($carDetails->isEmpty()) {
                return ResponseHelper::error('No car details', 404);
            }

            return ResponseHelper::success($carDetails, 'Car details retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function changeUserCarStatus(Request $request){
        try {

            $request->validate([
                'car_details_id' => 'required',
                'status' => 'required',
            ]);

            $user = Auth::user();

            // Find the car details for the authenticated user
            $carDetail = CarDetail::where('user_id', $user->id)->first();

            if ($carDetail) {
                // Update the car details with the new data
                $carDetail->update([
                    'car_details_id' => $request->car_details_id,
                    'status' => $request->status,
                ]);

                // Redirect or return response
                return ResponseHelper::success($carDetail, 'Car details updated successfully!');
            } else {
                return ResponseHelper::error('Car details not found.', 404);
            }

        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

}
