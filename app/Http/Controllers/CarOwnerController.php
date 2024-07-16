<?php

namespace App\Http\Controllers;

use App\Models\CarOwner;
use Illuminate\Http\Request;

class CarOwnerController extends Controller
{
    public function index()
    {
        $carOwners = CarOwner::all();
        return view('admin.car-owners.index', compact('carOwners'));
    }

    public function create()
    {
        return view('admin.car-owners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        CarOwner::create($request->all());

        return redirect()->route('car-owners.index')->with('success', 'Car Owner created successfully.');
    }

    public function edit(CarOwner $carOwner)
    {
        return view('admin.car-owners.edit', compact('carOwner'));
    }

    public function update(Request $request, CarOwner $carOwner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $carOwner->update($request->all());

        return redirect()->route('car-owners.index')->with('success', 'Car Owner updated successfully.');
    }

    public function destroy(CarOwner $carOwner)
    {
        $carOwner->delete();

        return redirect()->route('car-owners.index')->with('success', 'Car Owner deleted successfully.');
    }
}
