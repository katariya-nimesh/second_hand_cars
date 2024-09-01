<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarVariantType;
use Illuminate\Http\Request;

class CarVariantTypeController extends Controller
{
    public function index()
    {
        $carVariantTypes = CarVariantType::all();
        return view('admin.car-variant-types.index', compact('carVariantTypes'));
    }

    public function create()
    {
        return view('admin.car-variant-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:car_varient_type,name',
        ]);

        CarVariantType::create($request->all());

        return redirect()->route('manage-variant-types')->with('success', 'Car Variant Type created successfully.');
    }

    public function edit($id)
    {
        $carVariantType = CarVariantType::find($id);
        return view('admin.car-variant-types.edit', compact('carVariantType'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:car_varient_type,name,' . $request->id,
        ]);

        $carVariantType = CarVariantType::find($request->id);
        $carVariantType->update($request->all());

        return redirect()->route('manage-variant-types')->with('success', 'Car Variant Type updated successfully.');
    }

    public function destroy($id)
    {
        CarVariantType::find($id)->delete();

        return redirect()->route('manage-variant-types')->with('success', 'Car Variant Type deleted successfully.');
    }
}
