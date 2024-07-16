<?php

namespace App\Http\Controllers;

use App\Models\CarVariant;
use App\Models\CarRegistrationYear;
use Illuminate\Http\Request;

class CarVarientController extends Controller
{
    public function index()
    {
        $carVarients = CarVariant::with('car_registration_year')->get();
        return view('admin.car-varients.index', compact('carVarients'));
    }

    public function create()
    {
        $carRegistrationYears = CarRegistrationYear::all();
        return view('admin.car-varients.create', compact('carRegistrationYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'car_registration_year_id' => 'required|exists:car_registration_years,id',
        ]);

        CarVariant::create($request->all());

        return redirect()->route('car-varients.index')->with('success', 'Car Varient created successfully.');
    }

    public function edit(CarVariant $carVarient)
    {
        $carRegistrationYears = CarRegistrationYear::all();
        return view('admin.car-varients.edit', compact('carVarient', 'carRegistrationYears'));
    }

    public function update(Request $request, CarVariant $carVarient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'car_registration_year_id' => 'required|exists:car_registration_years,id',
        ]);

        $carVarient->update($request->all());

        return redirect()->route('car-varients.index')->with('success', 'Car Varient updated successfully.');
    }

    public function destroy(CarVariant $carVarient)
    {
        $carVarient->delete();

        return redirect()->route('car-varients.index')->with('success', 'Car Varient deleted successfully.');
    }
}
