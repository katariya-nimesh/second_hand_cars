<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();
        return view('admin.vendor.index', compact('vendors'));
    }

    public function create()
    {
        return view('admin.vendor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'location'  => 'required',
            'phoneno'   => 'required'
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'location'  => $request->location,
            'phoneno'   => $request->phoneno,
            'user_type' => "vendor",
            'uid'       => "xyz",
            'fcm_token' => "xyz"
        ]);

        return redirect()->route('manage-vendors')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $vendor = Vendor::find($id);
        return view('admin.vendor.edit', compact('vendor'));
    }

    public function details($id)
    {
        $vendor = Vendor::find($id);
        return view('admin.vendor.details', compact('vendor'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users,email,' . $request->id,
            'location'  => 'required',
            'phoneno'   => 'required'
        ]);

        $vendor = Vendor::find($request->id);
        $vendor->fill($request->all());

        $vendor->save();

        return redirect()->route('manage-vendors')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();

        return redirect()->route('manage-vendors')->with('success', 'User deleted successfully.');
    }

    public function changeStatus(Request $request){
        $vendor = Vendor::find($request->id);
        $vendor->status = $request->status;
        $vendor->update();

        return response()->json(["message" => "Status updated successfully !"]);
    }

    public function profileApprove(Request $request){
        $vendor = Vendor::find($request->id);
        $vendor->vendor_status = $request->status;
        $vendor->update();

        return response()->json(["message" => "Status updated successfully !"]);
    }

    public function vendorProfileWebPage($id){
        try {
            $vendor = Vendor::where('id', $id)->first();

            if (!$vendor) {
                return ResponseHelper::error('Vendor not found', 404);
            }

            return view('vendor-profile', compact('vendor'));

        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
