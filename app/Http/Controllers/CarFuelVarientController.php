<?php

namespace App\Http\Controllers;

use App\Models\CarFuelVariant;
use App\Models\CarFuelType;
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
        $carFuelTypes = CarFuelType::all();
        return view('admin.car-fuel-varients.create', compact('carFuelTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'car_fuel_type_id' => 'required|exists:car_fuel_type,id',
        ]);

        CarFuelVariant::create($request->all());

        return redirect()->route('car-fuel-varients.index')->with('success', 'Car Fuel Varient created successfully.');
    }

    public function edit(CarFuelVariant $carFuelVarient)
    {
        $carFuelTypes = CarFuelType::all();
        return view('admin.car-fuel-varients.edit', compact('carFuelVarient', 'carFuelTypes'));
    }

    public function update(Request $request, CarFuelVariant $carFuelVarient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'car_fuel_type_id' => 'required|exists:car_fuel_type,id',
        ]);

        $carFuelVarient->update($request->all());

        return redirect()->route('car-fuel-varients.index')->with('success', 'Car Fuel Varient updated successfully.');
    }

    public function destroy(CarFuelVariant $carFuelVarient)
    {
        $carFuelVarient->delete();

        return redirect()->route('car-fuel-varients.index')->with('success', 'Car Fuel Varient deleted successfully.');
    }
}
