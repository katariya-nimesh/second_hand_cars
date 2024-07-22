<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $carBrand = new CarBrand($request->all());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/car_brand');
            $carBrand->image = Storage::url($path);
        }

        $carBrand->save();

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
            'name' => 'required|unique:car_brand,name,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $carBrand = CarBrand::find($id);
        $carBrand->fill($request->all());

        if ($request->hasFile('image')) {
            if ($carBrand->image) {
                $oldImagePath = str_replace('/storage', 'public', $carBrand->image);
                Storage::delete($oldImagePath);
            }
            $path = $request->file('image')->store('public/car_brand');
            $carBrand->image = Storage::url($path);
        }

        $carBrand->save();

        return redirect()->route('car-brands.index')->with('success', 'Car brand updated successfully.');
    }

    public function destroy($id)
    {
        $carBrand = CarBrand::find($id);

        if ($carBrand->image) {
            $oldImagePath = str_replace('/storage', 'public', $carBrand->image);
            Storage::delete($oldImagePath);
        }

        $carBrand->delete();

        return redirect()->route('car-brands.index')->with('success', 'Car brand deleted successfully.');
    }
}
