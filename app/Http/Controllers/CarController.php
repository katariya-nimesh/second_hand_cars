<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\CarBrand;
use App\Models\CarRegistrationYear;
use App\Models\CarVariant;
use App\Models\CarFuelType;
use App\Models\CarFuelVariant;


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

}
