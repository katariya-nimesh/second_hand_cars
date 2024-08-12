<?php

namespace App\Http\Controllers;

use App\Models\CarFuelVariant;
use App\Models\CarFuelType;
use App\Models\CarBrand;
use App\Models\CarRegistrationYear;
use App\Models\CarVariant;
use Illuminate\Http\Request;

class CarFuelVarientController extends Controller
{
    public function index()
    {
        $carFuelVarients = CarFuelVariant::with('car_fuel_type')->get();
        return view('admin.car-fuel-varients.index', compact('carFuelVarients'));
    }

    public function create()
    {
        $carBrands = CarBrand::all();
        $carFuelTypes = CarFuelType::all();
        return view('admin.car-fuel-varients.create', compact('carBrands', 'carFuelTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'car_fuel_type_id' => 'required|exists:car_fuel_type,id',
            'car_variant_id' => 'required|exists:car_varient,id',
            'car_registration_year_id' => 'required|exists:car_registration_years,id',
            'car_brand_id' => 'required|exists:car_brand,id',
        ]);

        CarFuelVariant::create($request->all());

        return redirect()->route('manage-fuel-varients')->with('success', 'Car Fuel Variant created successfully.');
    }

    public function edit($id)
    {
        $carFuelVarient = CarFuelVariant::find($id);
        $carBrands = CarBrand::all();
        $carFuelTypes = CarFuelType::all();
        $carRegistrationYears = CarRegistrationYear::where('car_brand_id', $carFuelVarient->car_fuel_type->car_varient->car_registration_year->car_brand->id)->get();
        $carVariants = CarVariant::where('car_registration_year_id', $carFuelVarient->car_fuel_type->car_varient->car_registration_year->id)->get();
        return view('admin.car-fuel-varients.edit', compact('carFuelVarient', 'carFuelTypes', 'carBrands', 'carRegistrationYears', 'carVariants'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'car_fuel_type_id' => 'required|exists:car_fuel_type,id',
            'car_variant_id' => 'required|exists:car_varient,id',
            'car_registration_year_id' => 'required|exists:car_registration_years,id',
            'car_brand_id' => 'required|exists:car_brand,id',
        ]);

        $carFuelVarient = CarFuelVariant::find($request->id);
        $carFuelVarient->update($request->all());

        return redirect()->route('manage-fuel-varients')->with('success', 'Car Fuel Variant updated successfully.');
    }

    public function destroy(Request $request)
    {
        CarFuelVariant::find($request->id)->delete();

        return redirect()->route('manage-fuel-varients')->with('success', 'Car Fuel Variant deleted successfully.');
    }

    public function getRegistrationYears($carBrandId)
    {
        $registrationYears = CarRegistrationYear::where('car_brand_id', $carBrandId)->get();
        return response()->json($registrationYears);
    }

    public function getVariants($carRegistrationYearId)
    {
        $carVariants = CarVariant::where('car_registration_year_id', $carRegistrationYearId)->get();
        return response()->json($carVariants);
    }

    public function getFuelTypes($carVariantId)
    {
        $carFuelTypes = CarFuelType::where('car_varient_id', $carVariantId)->get();
        return response()->json($carFuelTypes);
    }

    public function getFuelTypesVarient($fuelTypeId)
    {
        $carFuelTypes = CarFuelVariant::where('car_fuel_type_id', $fuelTypeId)->get();
        return response()->json($carFuelTypes);
    }
}
