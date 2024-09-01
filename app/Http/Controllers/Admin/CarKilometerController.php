<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarKilometer;
use Illuminate\Http\Request;

class CarKilometerController extends Controller
{
    public function index()
    {
        $carKilometers = CarKilometer::all();
        return view('admin.car-kilometers.index', compact('carKilometers'));
    }

    public function create()
    {
        return view('admin.car-kilometers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_km' => 'required|integer|min:0',
            'end_km' => 'required|integer|gt:start_km', // End km must be greater than start km
        ]);

        $start_km = $request->input('start_km');
        $end_km = $request->input('end_km');

        $isOverlapping = false;
        $existingRanges = CarKilometer::all(['start_km', 'end_km']);

        foreach ($existingRanges as $range) {
            $existingStartKm = $range->start_km;
            $existingEndKm = $range->end_km;

            if (($start_km >= $existingStartKm && $start_km <= $existingEndKm) ||
                ($end_km >= $existingStartKm && $end_km <= $existingEndKm) ||
                ($start_km <= $existingStartKm && $end_km >= $existingEndKm)
            ) {
                $isOverlapping = true;
                break;
            }
        }

        if ($isOverlapping) {
            return redirect()->back()->withInput()->withErrors(['start_km' => 'The kilometer range overlaps with an existing range.']);
        } else {
            CarKilometer::create([
                'start_km' => $start_km,
                'end_km' => $end_km,
            ]);

            return redirect()->route('manage-kilometers')->with('success', 'Kilometer range added successfully.');
        }
    }

    public function edit($id)
    {
        $carKilometer = CarKilometer::find($id);
        return view('admin.car-kilometers.edit', compact('carKilometer'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'start_km' => 'required|integer|min:0',
            'end_km' => 'required|integer|gt:start_km', // End km must be greater than start km
        ]);

        $start_km = $request->input('start_km');
        $end_km = $request->input('end_km');

        $existingRanges = CarKilometer::where('id', '!=', $request->id)->get(['start_km', 'end_km']);

        $isOverlapping = false;

        foreach ($existingRanges as $range) {
            $existingStartKm = $range->start_km;
            $existingEndKm = $range->end_km;

            // Check if the new range overlaps with the existing range
            if (($start_km >= $existingStartKm && $start_km <= $existingEndKm) ||
                ($end_km >= $existingStartKm && $end_km <= $existingEndKm) ||
                ($start_km <= $existingStartKm && $end_km >= $existingEndKm)
            ) {
                $isOverlapping = true;
                break;
            }
        }

        if ($isOverlapping) {
            return redirect()->back()->withInput()->withErrors(['start_km' => 'The kilometer range overlaps with an existing range.']);
        } else {
            // Update the existing record
            $carKilometer = CarKilometer::find($request->id);
            $carKilometer->start_km = $start_km;
            $carKilometer->end_km = $end_km;
            $carKilometer->save();

            return redirect()->route('manage-kilometers')->with('success', 'Car Kilometer range updated successfully.');
        }
    }

    public function destroy($id)
    {
        CarKilometer::find($id)->delete();

        return redirect()->route('manage-kilometers')->with('success', 'Car Kilometer range deleted successfully.');
    }
}
