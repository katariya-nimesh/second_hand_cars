<?php

namespace App\Http\Controllers;

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
            'start_km' => 'required|integer',
            'end_km' => 'required|integer|gt:start_km', // End km must be greater than start km
        ]);
    
        $start_km = $request->input('start_km');
        $end_km = $request->input('end_km');
    
        // Check if the new range overlaps with existing ranges
        $overlappingRange = CarKilometer::where(function ($query) use ($start_km,$end_km) {
            $query->whereBetween('start_km', [$start_km, $end_km])
                  ->orWhereBetween('end_km', [$start_km, $end_km])
                  ->orWhere(function ($query) use ($start_km,$end_km) {
                      $query->where('start_km', '<=', $start_km)
                            ->where('end_km', '>=', $end_km);
                  });
        })->exists();
    
        if ($overlappingRange) {
            return redirect()->back()->withInput()->withErrors(['start_km' => 'The kilometer range overlaps with an existing range.']);
        }
    
        // Check if the new range duplicates an existing range
        $duplicateRange = CarKilometer::where('start_km', $start_km)->where('end_km', $end_km)->exists();
    
        if ($duplicateRange) {
            return redirect()->back()->withInput()->withErrors(['start_km' => 'The kilometer range already exists.']);
        }
    
        CarKilometer::create([
            'start_km' => $start_km,
            'end_km' => $end_km,
        ]);
    
        return redirect()->route('car-kilometers.index')->with('success', 'Car Kilometer range created successfully.');
    }

    public function edit(CarKilometer $carKilometer)
    {
        return view('admin.car-kilometers.edit', compact('carKilometer'));
    }

    public function update(Request $request, CarKilometer $carKilometer)
    {
        $request->validate([
            'start_km' => 'required|integer',
            'end_km' => 'required|integer|gt:start_km', // End km must be greater than start km
        ]);
    
        $start_km = $request->input('start_km');
        $end_km = $request->input('end_km');
    
        // Check if the updated range overlaps with other ranges
        $overlappingRange = CarKilometer::where(function ($query) use ($start_km, $end_km, $carKilometer) {
            $query->whereBetween('start_km', [$start_km, $end_km])
                  ->orWhereBetween('end_km', [$start_km, $end_km])
                  ->orWhere(function ($query) use ($start_km,$end_km) {
                      $query->where('start_km', '<=', $start_km)
                            ->where('end_km', '>=', $end_km);
                  });
        })->where('id',"!=",$request->id)->exists();

        if ($overlappingRanges) {
            return redirect()->back()->withInput()->withErrors(['start_km' => 'The kilometer range overlaps with an existing range.']);
        }
    
        // Update the car kilometer range
        $carKilometer->update([
            'start_km' => $start_km,
            'end_km' => $end_km,
        ]);
    
        return redirect()->route('car-kilometers.index')->with('success', 'Car Kilometer range updated successfully.');
    }

    public function destroy(CarKilometer $carKilometer)
    {
        $carKilometer->delete();

        return redirect()->route('car-kilometers.index')->with('success', 'Car Kilometer range deleted successfully.');
    }
}
