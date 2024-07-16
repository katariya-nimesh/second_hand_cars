<?php

namespace App\Http\Controllers;

use App\Models\CarFuelType;
use App\Models\CarVariant;
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
        $carVarients = CarVariant::all();
        return view('admin.car-fuel-types.create', compact('carVarients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fuel_type' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'car_varient_id' => 'required|exists:car_varient,id',
        ]);

        CarFuelType::create($request->all());

        return redirect()->route('car-fuel-types.index')->with('success', 'Car Fuel Type created successfully.');
    }

    public function edit(CarFuelType $carFuelType)
    {
        $carVarients = CarVariant::all();
        return view('admin.car-fuel-types.edit', compact('carFuelType', 'carVarients'));
    }

    public function update(Request $request, CarFuelType $carFuelType)
    {
        $request->validate([
            'fuel_type' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'car_varient_id' => 'required|exists:car_varient,id',
        ]);

        $carFuelType->update($request->all());

        return redirect()->route('car-fuel-types.index')->with('success', 'Car Fuel Type updated successfully.');
    }

    public function destroy(CarFuelType $carFuelType)
    {
        $carFuelType->delete();

        return redirect()->route('car-fuel-types.index')->with('success', 'Car Fuel Type deleted successfully.');
    }
}
 