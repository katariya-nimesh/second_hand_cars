<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarFuelType;
use Illuminate\Http\Request;

class CarFuelTypeController extends Controller
{
    public function index()
    {
        $carFuelTypes = CarFuelType::all();
        return view('admin.car-fuel-types.index', compact('carFuelTypes'));
    }

    public function create()
    {
        return view('admin.car-fuel-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fuel_type' => 'required|string|max:255|unique:car_fuel_type,fuel_type',
        ]);

        CarFuelType::create([
            'fuel_type' => $request->fuel_type,
        ]);

        return redirect()->route('manage-fuel-types')->with('success', 'Car Fuel Type created successfully.');
    }

    public function edit($id)
    {
        $carFuelType = CarFuelType::find($id);
        return view('admin.car-fuel-types.edit', compact('carFuelType'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'fuel_type' => 'required|string|max:255|unique:car_fuel_type,fuel_type,' . $request->id,
        ]);

        $carFuelType = CarFuelType::find($request->id);

        $carFuelType->update([
            'fuel_type' => $request->fuel_type,
        ]);

        return redirect()->route('manage-fuel-types')->with('success', 'Car Fuel Type updated successfully.');
    }

    public function destroy($id)
    {
        CarFuelType::find($id)->delete();

        return redirect()->route('manage-fuel-types')->with('success', 'Car Fuel Type deleted successfully.');
    }
}
