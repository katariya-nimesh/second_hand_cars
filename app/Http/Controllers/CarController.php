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

    public function getRegistrationYearsByBrandId()
    {
        try {
            $years = CarRegistrationYear::orderBy('year', 'desc')->get();

            if ($years->isEmpty()) {
                return ResponseHelper::error('No registration years found', 404);
            }

            return ResponseHelper::success($years, 'Registration years retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function getCarVarientByBrandId($id)
    {
        try {
            $carVarient = CarVariant::with('car_brand')->where('car_brand_id', $id)->get();

            if ($carVarient->isEmpty()) {
                return ResponseHelper::error('No car varient', 404);
            }

            return ResponseHelper::success($carVarient, 'Car Varient retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function getCarFuelTypeByVarientId()
    {
        try {
            $carFuelType = CarFuelType::all();

            if ($carFuelType->isEmpty()) {
                return ResponseHelper::error('No car fuel type', 404);
            }

            return ResponseHelper::success($carFuelType, 'Car Fuel Type retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }


    public function getCarFuelVarientByCarFuelTypeId()
    {
        try {
            $carfuelVarient = CarFuelVariant::all();

            if ($carfuelVarient->isEmpty()) {
                return ResponseHelper::error('No car fuel varient', 404);
            }

            return ResponseHelper::success($carfuelVarient, 'Car Fuel Varient retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function getCarVarientTypeByCarFuelVarientId()
    {
        try {
            $carVarientType = CarVariantType::all();

            if ($carVarientType->isEmpty()) {
                return ResponseHelper::error('No car varient type', 404);
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
                'status' => 'required',
                'publish_status' => 'required',
                'car_brand_id'=> 'required' ,
                'car_registration_year_id'=> 'required' ,
                'car_varient_id'=> 'required' ,
                'transmission'=> 'required' ,
                'car_fuel_type_id'=> 'required' ,
                'car_fuel_varient_id'=> 'required' ,
            ];

            // Validate the request
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return ResponseHelper::validationError($validator->errors());
            }
            $user = Auth::user();

            $isUpdate = $request->has('car_details_id');

            if ($isUpdate) {
                $carDetails = CarDetail::find($request->car_details_id);

                if (!$carDetails) {
                    return ResponseHelper::error('Car details not found', 404);
                }

                if(!($carDetails->status == "Active" && $carDetails->publish_status == "Publish")){
                    if($request->status == "Active" && $request->publish_status == "Publish"){
                        // check the user can update the status or not
                        if(!$user->plan_active){
                            return ResponseHelper::success(null, 'Car can not be updated! Please upgrade your plan');
                        }
                    }
                }


                // Update car details
                $carDetails->update([
                    'car_varient_type_id' => $request->car_varient_type_id,
                    'car_owner_id' => $request->car_owner_id,
                    'car_kilometer_id' => $request->car_kilometer_id,
                    'price' => $request->price,
                    'accident' => $request->accident,
                    'status' => $request->status,
                    'publish_status' => $request->publish_status,
                    'car_brand_id'=> $request->car_brand_id,
                    'car_registration_year_id'=> $request->car_registration_year_id,
                    'car_varient_id'=> $request->car_varient_id,
                    'transmission'=> $request->transmission,
                    'car_fuel_type_id'=> $request->car_fuel_type_id,
                    'car_fuel_varient_id'=> $request->car_fuel_varient_id,
                ]);

                // Delete old images if new images are provided
                if ($request->hasFile('images')) {
                    $oldImages = CarImage::where('car_details_id', $carDetails->id)->where('type', 'image')->get();
                    foreach ($oldImages as $oldImage) {
                        $oldImagePath = str_replace('/storage', 'public', $oldImage->image);
                        Storage::delete($oldImagePath);
                        $oldImage->delete();
                    }
                }

                // Delete old videos if new videos are provided
                if ($request->hasFile('videos')) {
                    $oldVideos = CarImage::where('car_details_id', $carDetails->id)->where('type', 'video')->get();
                    foreach ($oldVideos as $oldVideo) {
                        $oldVideoPath = str_replace('/storage', 'public', $oldVideo->image);
                        Storage::delete($oldVideoPath);
                        $oldVideo->delete();
                    }
                }
            } else {
                // Add new car details
                if($request->status == "Active" && $request->publish_status == "Publish"){
                    // check the user can update the status or not
                    if(!$user->plan_active){
                        return ResponseHelper::success(null, 'Car can not be added! Please upgrade your plan');
                    }
                }

                $carDetails = CarDetail::create([
                    'user_id' => $user->id,
                    'car_varient_type_id' => $request->car_varient_type_id,
                    'car_owner_id' => $request->car_owner_id,
                    'car_kilometer_id' => $request->car_kilometer_id,
                    'price' => $request->price,
                    'accident' => $request->accident,
                    'status' => $request->status,
                    'publish_status' => $request->publish_status,
                    'car_brand_id'=> $request->car_brand_id,
                    'car_registration_year_id'=> $request->car_registration_year_id,
                    'car_varient_id'=> $request->car_varient_id,
                    'transmission'=> $request->transmission,
                    'car_fuel_type_id'=> $request->car_fuel_type_id,
                    'car_fuel_varient_id'=> $request->car_fuel_varient_id,
                ]);
            }

            // Handle images upload
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('public/images');
                    CarImage::create([
                        'image' => Storage::url($path),
                        'type' => 'image',
                        'car_details_id' => $carDetails->id,
                    ]);
                }
            }

            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $video) {
                    $path = $video->store('public/videos');
                    CarImage::create([
                        'image' => Storage::url($path),
                        'type' => 'video',
                        'car_details_id' => $carDetails->id,
                    ]);
                }
            }

            // Return a response
            return ResponseHelper::success($carDetails, 'Car Details Add successfully');

        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function getUserCarDetails(Request $request, $status = null){
        try {
            $user = Auth::user();

            $query = CarDetail::with([
                'car_varient_type',
                'car_brand',
                'car_registration_year',
                'car_varient',
                'car_fuel_type',
                'car_fuel_varient',
                'car_owner',
                'car_kilometer',
                'car_image',
                'user'
            ])->where('user_id', $user->id);

            if ($status == "Deactive" || $status == "Active") {
                $query->where('status', $status)->where('publish_status', 'Publish');
            } elseif ($status == "Save") {
                $query->where('publish_status', $status);
            }
            $perPage = $request->input('per_page', 10);
            $carDetails = $query->orderBy('created_at', 'desc')->paginate($perPage);

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
                'publish_status' => 'required',
            ]);

            $user = Auth::user();

            // Find the car details for the authenticated user
            $carDetail = CarDetail::where('user_id', $user->id)->where('id', $request->car_details_id)->first();

            if ($carDetail) {
                if($request->status == "Active" && $request->publish_status == "Publish"){
                    // check the user can update the status or not
                    if(!$user->plan_active){
                        return ResponseHelper::success(null, 'Car status can not updated! Please upgrade your plan');
                    }
                }

                // Update the car details with the new data
                $carDetail->update([
                    'car_details_id' => $request->car_details_id,
                    'status' => $request->status,
                    'publish_status' => $request->publish_status,
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

    public function getAllCars(Request $request){
        try {
            $query = CarDetail::with([
                'car_varient_type',
                'car_brand',
                'car_registration_year',
                'car_varient',
                'car_fuel_type',
                'car_fuel_varient',
                'car_owner',
                'car_kilometer',
                'car_image',
                'user'
            ])->where('status', "Active")->where('publish_status', 'Publish');

            // Apply dynamic filters

            // Company(brand) name
            if ($request->has('car_brand_id') && !empty($request->car_brand_id)) {
                $query->where('car_brand_id', $request->car_brand_id);
            }

            // Registration year
            if ($request->has('car_registration_year_id') && !empty($request->car_registration_year_id)) {
                $query->where('car_registration_year_id', $request->car_registration_year_id);
            }

            // Model
            if ($request->has('car_varient_id') && !empty($request->car_varient_id)) {
                $query->where('car_varient_id', $request->car_varient_id);
            }

            // Varient
            if ($request->has('car_fuel_varient_id') && !empty($request->car_fuel_varient_id)) {
                $query->where('car_fuel_varient_id', $request->car_fuel_varient_id);
            }

            // Type
            if ($request->has('car_varient_type_id') && !empty($request->car_varient_type_id)) {
                $query->where('car_varient_type_id', $request->car_varient_type_id);
            }

            // Owner
            if ($request->has('car_owner_id') && !empty($request->car_owner_id)) {
                $query->where('car_owner_id', $request->car_owner_id);
            }

            // Kilometer
            if ($request->has('car_kilometer_id') && !empty($request->car_kilometer_id)) {
                $query->where('car_kilometer_id', $request->car_kilometer_id);
            }

            // Price
            if ($request->has('price_min') && !empty($request->price_min)) {
                $query->where('price', '>=', $request->price_min);
            }

            if ($request->has('price_max') && !empty($request->price_max)) {
                $query->where('price', '<=', $request->price_max);
            }

            // Vendor
            if ($request->has('car_vendor_id') && !empty($request->car_vendor_id)) {
                $query->where('user_id', $request->car_vendor_id);
            }

            // Location
            if ($request->has('location') && !empty($request->location)) {
                $query->whereHas('user', function($q) use ($request) {
                    $q->where('location', $request->location);
                });
            }

            // Fuel type
            if ($request->has('car_fuel_type_id') && !empty($request->car_fuel_type_id)) {
                $query->where('car_fuel_type_id', $request->car_fuel_type_id);
            }

            // transmission
            if ($request->has('transmission') && !empty($request->transmission)) {
                $query->where('transmission', $request->transmission);
            }


            // Get the number of items per page from the request, default to 10 if not provided
            $perPage = $request->input('per_page', 10);

            // Sorting
            if ($request->has('sorting') && !empty($request->sorting)) {
                $sorting = $request->sorting;

                // Ensure the sorting parameter is either 'asc' or 'desc'
                if (in_array($sorting, ['asc', 'desc'])) {
                    $query->orderByRaw('CAST(price AS DECIMAL(10, 2)) ' . $sorting);
                } else {
                    // Handle invalid sorting parameter, maybe set a default or return an error
                    $query->orderByRaw('CAST(price AS DECIMAL(10, 2)) asc'); // Default to ascending if sorting is invalid
                }
            }

            // Paginate the results
            $carDetails = $query->paginate($perPage);

            if ($carDetails->isEmpty()) {
                return ResponseHelper::error('No car details', 404);
            }

            return ResponseHelper::success($carDetails, 'Car details retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function getCarFuelVarientByCarVarientId($carVarientId)
    {
        try {
            // Get car fuel types by car variant ID
            $carFuelTypes = CarFuelType::where('car_varient_id', $carVarientId)->get();

            if ($carFuelTypes->isEmpty()) {
                return ResponseHelper::error('No car fuel type on this given car variant ID', 404);
            }

            // Get car fuel variants by car fuel type IDs
            $carFuelTypeIds = $carFuelTypes->pluck('id');
            $carFuelVariants = CarFuelVariant::whereIn('car_fuel_type_id', $carFuelTypeIds)->get();

            if ($carFuelVariants->isEmpty()) {
                return ResponseHelper::error('No car fuel variant on this given car variant ID', 404);
            }

            return ResponseHelper::success($carFuelVariants, 'Car Fuel Variants retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function destroyCarDetails($id){
        try{

            $carDetails = CarDetail::find($id);

            if (!$carDetails) {
                return ResponseHelper::error('Car not found', 404);
            }

            $carDetails->delete();
            return ResponseHelper::success(null, 'Car removed from car details successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
