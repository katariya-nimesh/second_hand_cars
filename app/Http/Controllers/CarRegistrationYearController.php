<?php

namespace App\Http\Controllers;

use App\Models\CarRegistrationYear;
use App\Models\CarBrand;
use Illuminate\Http\Request;

class CarRegistrationYearController extends Controller
{
    public function index()
    {
        // Update the relationship name here
        $carRegistrationYears = CarRegistrationYear::with('car_brand')->get();
        return view('admin.car-registration-years.index', compact('carRegistrationYears'));
    }

    public function create()
    {
        $carBrands = CarBrand::all();
        return view('admin.car-registration-years.create', compact('carBrands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
            'car_brand_id' => 'required|exists:car_brand,id',
        ]);

        CarRegistrationYear::create($request->all());

        return redirect()->route('car-registration-years.index')->with('success', 'Car registration year created successfully.');
    }

    public function edit($id)
    {
        $carRegistrationYear = CarRegistrationYear::find($id);
        $carBrands = CarBrand::all();
        return view('admin.car-registration-years.edit', compact('carRegistrationYear', 'carBrands'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'year' => 'required|integer',
            'car_brand_id' => 'required|exists:car_brand,id',
        ]);

        $carRegistrationYear = CarRegistrationYear::find($id);
        $carRegistrationYear->update($request->all());

        return redirect()->route('car-registration-years.index')->with('success', 'Car registration year updated successfully.');
    }

    public function destroy($id)
    {
        CarRegistrationYear::find($id)->delete();
        return redirect()->route('car-registration-years.index')->with('success', 'Car registration year deleted successfully.');
    }
}
