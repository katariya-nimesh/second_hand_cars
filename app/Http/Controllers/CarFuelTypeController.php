<?php

namespace App\Http\Controllers;

use App\Models\CarFuelType;
use App\Models\CarVariant;
use App\Models\CarBrand;
use App\Models\CarRegistrationYear;
use Illuminate\Http\Request;

class CarFuelTypeController extends Controller
{
    public function index()
    {
        $carFuelTypes = CarFuelType::with('car_varient')->get();
        return view('admin.car-fuel-types.index', compact('carFuelTypes'));
    }

    public function create()
    {
        $carBrands = CarBrand::all();
        return view('admin.car-fuel-types.create', compact('carBrands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fuel_type' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'car_varient_id' => 'required|exists:car_varient,id',
        ]);

        CarFuelType::create([
            'fuel_type' => $request->fuel_type,
            'transmission' => $request->transmission,
            'car_varient_id' => $request->car_varient_id,
        ]);

        return redirect()->route('car-fuel-types.index')->with('success', 'Car Fuel Type created successfully.');
    }

    public function edit(CarFuelType $carFuelType)
    {
        $carBrands = CarBrand::all();
        return view('admin.car-fuel-types.edit', compact('carFuelType', 'carBrands'));
    }

    public function update(Request $request, CarFuelType $carFuelType)
    {
        $request->validate([
            'fuel_type' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'car_varient_id' => 'required|exists:car_varient,id',
        ]);

        $carFuelType->update([
            'fuel_type' => $request->fuel_type,
            'transmission' => $request->transmission,
            'car_varient_id' => $request->car_varient_id,
        ]);

        return redirect()->route('car-fuel-types.index')->with('success', 'Car Fuel Type updated successfully.');
    }

    public function destroy(CarFuelType $carFuelType)
    {
        $carFuelType->delete();

        return redirect()->route('car-fuel-types.index')->with('success', 'Car Fuel Type deleted successfully.');
    }

    public function getRegistrationYears(Request $request)
    {
        $carBrandId = $request->query('car_brand_id');
        return CarRegistrationYear::where('car_brand_id', $carBrandId)->get();
    }

    public function getVariants(Request $request)
    {
        $carRegistrationYearId = $request->query('car_registration_year_id');
        return CarVariant::where('car_registration_year_id', $carRegistrationYearId)->get();
    }
}