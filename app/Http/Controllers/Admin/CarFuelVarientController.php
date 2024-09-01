<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarFuelVariant;
use Illuminate\Http\Request;

class CarFuelVarientController extends Controller
{
    public function index()
    {
        $carFuelVarients = CarFuelVariant::all();
        return view('admin.car-fuel-varients.index', compact('carFuelVarients'));
    }

    public function create()
    {
        return view('admin.car-fuel-varients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:car_fuel_varient,name',
        ]);

        CarFuelVariant::create($request->all());

        return redirect()->route('manage-fuel-varients')->with('success', 'Car Fuel Variant created successfully.');
    }

    public function edit($id)
    {
        $carFuelVarient = CarFuelVariant::find($id);
        return view('admin.car-fuel-varients.edit', compact('carFuelVarient'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:car_fuel_varient,name,' . $request->id,
        ]);

        $carFuelVarient = CarFuelVariant::find($request->id);
        $carFuelVarient->update($request->all());

        return redirect()->route('manage-fuel-varients')->with('success', 'Car Fuel Variant updated successfully.');
    }

    public function destroy($id)
    {
        CarFuelVariant::find($id)->delete();

        return redirect()->route('manage-fuel-varients')->with('success', 'Car Fuel Variant deleted successfully.');
    }
}
