<?php

namespace App\Http\Controllers;

use App\Models\CarVariantType;
use App\Models\CarFuelVariant;
use App\Models\CarBrand;
use App\Models\CarFuelType;
use App\Models\CarRegistrationYear;
use App\Models\CarVariant;
use Illuminate\Http\Request;

class CarVariantTypeController extends Controller
{
    public function index()
    {
        $carVariantTypes = CarVariantType::with('car_fuel_varient')->get();
        return view('admin.car-variant-types.index', compact('carVariantTypes'));
    }

    public function create()
    {
        $carBrands = CarBrand::all();
        $carFuelVariants = CarFuelVariant::all();
        return view('admin.car-variant-types.create', compact('carBrands', 'carFuelVariants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'car_fuel_varient_id' => 'required|exists:car_fuel_varient,id',
        ]);

        CarVariantType::create($request->all());

        return redirect()->route('manage-variant-types')->with('success', 'Car Variant Type created successfully.');
    }

    public function edit($id)
    {
        $carVariantType = CarVariantType::find($id);
        $carBrands = CarBrand::all();
        $yearSelect = CarRegistrationYear::all();
        $variantSelect = CarVariant::all();
        $fuelTypeSelect = CarFuelType::all();
        $carFuelVariants = CarFuelVariant::all();
        return view('admin.car-variant-types.edit', compact('carVariantType', 'carBrands','yearSelect','variantSelect','fuelTypeSelect', 'carFuelVariants'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'car_fuel_varient_id' => 'required|exists:car_fuel_varient,id',
        ]);

        $carVariantType = CarVariantType::find($request->id);
        $carVariantType->update($request->all());

        return redirect()->route('manage-variant-types')->with('success', 'Car Variant Type updated successfully.');
    }

    public function destroy(Request $request)
    {
        CarVariantType::find($request->id)->delete();

        return redirect()->route('manage-variant-types')->with('success', 'Car Variant Type deleted successfully.');
    }
}
