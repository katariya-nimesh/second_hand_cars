<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarBrand;
use App\Models\CarVariant;
use Illuminate\Http\Request;

class CarVarientController extends Controller
{
    public function index()
    {
        $carVarients = CarVariant::all();
        return view('admin.car-varients.index', compact('carVarients'));
    }

    public function create()
    {
        $brands = CarBrand::all();
        return view('admin.car-varients.create',compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:car_varient,name',
            'car_brand_id' => 'required|exists:car_brand,id',
        ]);

        CarVariant::create($request->all());

        return redirect()->route('manage-varients')->with('success', 'Car Varient created successfully.');
    }

    public function edit($id)
    {
        $carVarient = CarVariant::find($id);
        $brands = CarBrand::all();
        return view('admin.car-varients.edit', compact('carVarient','brands'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:car_varient,name,' . $request->id,
            'car_brand_id' => 'required|exists:car_brand,id',
        ]);

        $carVarient = CarVariant::find($request->id);
        $carVarient->update($request->all());

        return redirect()->route('manage-varients')->with('success', 'Car Varient updated successfully.');
    }

    public function destroy($id)
    {
        CarVariant::find($id)->delete();

        return redirect()->route('manage-varients')->with('success', 'Car Varient deleted successfully.');
    }
}
