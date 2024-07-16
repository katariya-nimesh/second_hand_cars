<?php

namespace App\Http\Controllers;

use App\Models\CarVariantType;
use App\Models\CarFuelVariant;
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
        $carFuelVariants = CarFuelVariant::all();
        return view('admin.car-variant-types.create', compact('carFuelVariants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'car_fuel_varient_id' => 'required|exists:car_fuel_varient,id',
        ]);

        CarVariantType::create($request->all());

        return redirect()->route('car-variant-types.index')->with('success', 'Car Variant Type created successfully.');
    }

    public function edit(CarVariantType $carVariantType)
    {
        $carFuelVariants = CarFuelVariant::all();
        return view('admin.car-variant-types.edit', compact('carVariantType', 'carFuelVariants'));
    }

    public function update(Request $request, CarVariantType $carVariantType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'car_fuel_varient_id' => 'required|exists:car_fuel_varient,id',
        ]);

        $carVariantType->update($request->all());

        return redirect()->route('car-variant-types.index')->with('success', 'Car Variant Type updated successfully.');
    }

    public function destroy(CarVariantType $carVariantType)
    {
        $carVariantType->delete();

        return redirect()->route('car-variant-types.index')->with('success', 'Car Variant Type deleted successfully.');
    }
}
