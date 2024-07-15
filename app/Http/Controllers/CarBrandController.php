<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{
    public function index()
    {
        $carBrands = CarBrand::all();
        return view('admin.car-brands.index', compact('carBrands'));
    }

    public function create()
    {
        return view('admin.car-brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:car_brand,name',
        ]);

        CarBrand::create($request->all());

        return redirect()->route('car-brands.index')->with('success', 'Car brand created successfully.');
    }

    public function edit($id)
    {
        $carBrand = CarBrand::find($id);
        return view('admin.car-brands.edit', compact('carBrand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:car_brand,name,'.$id,
        ]);

        $carBrand = CarBrand::find($id);
        $carBrand->update($request->all());

        return redirect()->route('car-brands.index')->with('success', 'Car brand updated successfully.');
    }

    public function destroy($id)
    {
        CarBrand::find($id)->delete();
        return redirect()->route('car-brands.index')->with('success', 'Car brand deleted successfully.');
    }
}
