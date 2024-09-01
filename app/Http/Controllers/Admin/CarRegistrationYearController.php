<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarRegistrationYear;
use Illuminate\Http\Request;

class CarRegistrationYearController extends Controller
{
    public function index()
    {
        $carRegistrationYears = CarRegistrationYear::all();
        return view('admin.car-registration-years.index', compact('carRegistrationYears'));
    }

    public function create()
    {
        return view('admin.car-registration-years.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|digits:4|unique:car_registration_years,year',
        ]);

        CarRegistrationYear::create($request->all());

        return redirect()->route('manage-registration-years')->with('success', 'Car registration year created successfully.');
    }

    public function edit($id)
    {
        $carRegistrationYear = CarRegistrationYear::find($id);
        return view('admin.car-registration-years.edit', compact('carRegistrationYear'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|digits:4|unique:car_registration_years,year,' . $request->id,
        ]);

        $carRegistrationYear = CarRegistrationYear::find($request->id);
        $carRegistrationYear->update($request->all());

        return redirect()->route('manage-registration-years')->with('success', 'Car registration year updated successfully.');
    }

    public function destroy($id)
    {
        CarRegistrationYear::find($id)->delete();
        return redirect()->route('manage-registration-years')->with('success', 'Car registration year deleted successfully.');
    }
}
