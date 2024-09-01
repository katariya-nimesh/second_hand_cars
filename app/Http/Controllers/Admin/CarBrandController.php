<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            'name'  => 'required|string|max:255|unique:car_brand,name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $carBrand = new CarBrand($request->all());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/car_brand');
            $carBrand->image = Storage::url($path);
        }

        $carBrand->save();

        return redirect()->route('dashboard')->with('success', 'Car brand created successfully.');
    }

    public function edit($id)
    {
        $carBrand = CarBrand::find($id);
        return view('admin.car-brands.edit', compact('carBrand'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:car_brand,name,' . $request->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $carBrand = CarBrand::find($request->id);

        if ($request->hasFile('image')) {
            if ($carBrand->getRawOriginal('image')) {
                $oldImagePath = str_replace('/storage', 'public', $carBrand->getRawOriginal('image'));
                Storage::delete($oldImagePath);
            }
            $path = $request->file('image')->store('public/car_brand');
            $newimage = Storage::url($path);
        }
        $carBrand->name     = $request->name;
        $carBrand->image    = $newimage ?? $carBrand->image;
        $carBrand->save();

        return redirect()->route('dashboard')->with('success', 'Car brand updated successfully.');
    }

    public function destroy($id)
    {
        $carBrand = CarBrand::find($id);

        if ($carBrand->getRawOriginal('image')) {
            $oldImagePath = str_replace('/storage', 'public', $carBrand->getRawOriginal('image'));
            Storage::delete($oldImagePath);
        }

        $carBrand->delete();

        return redirect()->route('dashboard')->with('success', 'Car brand deleted successfully.');
    }
}
