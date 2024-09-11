<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\CarDetail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index($type)
    {
        if ($type == 'user') {
            $users = User::where('user_type', 'user')->get();
            return view('admin.users.index', compact('users'));
        } else {
            $vendors = User::where('user_type','vendor')->orderby('vendor_status','desc')->get();
            return view('admin.vendor.index', compact('vendors'));
        }
    }

    public function create($type)
    {
        return view('admin.users.create',['type' => $type]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'phoneno' => 'required|integer|unique:users,phoneno',
            'business_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'user_type' => "required|in:user,vendor",
            'uid' => 'nullable|string|max:255',
            'fcm_token' => 'nullable|string|max:255',
            'image' => 'nullable|image',
            'year_of_establishment' => 'nullable|integer|digits:4',
            'gst_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'pincode' => 'nullable|integer|max:6',
            'business_email' => 'nullable|email',
            'type_of_business' => 'nullable|string|max:255',
            'name_of_partner_1' => 'nullable|string|max:255',
            'name_of_partner_2' => 'nullable|string|max:255',
            'phoneno_2' => 'nullable|integer|digits:10',
            'vendor_live_photo' => 'nullable|image',
            'business_live_photo' => 'nullable|image',
            'gst_certificate' => 'nullable|file',
            'partnersheep_deed' => 'nullable|file',
            'adharcard_one' => 'nullable|file',
            'adharcard_two' => 'nullable|file',
            'cancel_cheque' => 'nullable|file',
        ]);

        $user = new User();
        $user->fill($validatedData);

        $fileUploads = [
            'image',
            'vendor_live_photo',
            'business_live_photo',
            'gst_certificate',
            'partnersheep_deed',
            'adharcard_one',
            'adharcard_two',
            'cancel_cheque'
        ];

        foreach ($fileUploads as $fileUpload) {
            if ($request->hasFile($fileUpload)) {
                $folder = $fileUpload == 'image' ? 'profile_images' : $fileUpload;
                $path = $request->file($fileUpload)->store("public/{$folder}");
                $user->$fileUpload = Storage::url($path);
            }
        }

        $user->save();

        return redirect()->route('manage-users',['type' => $request->type])->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function details($id)
    {
        $user = User::find($id);
        return view('admin.users.details', compact('user'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|unique:users,email,' . $request->id,
            'phoneno' => 'required|integer|unique:users,phoneno,' . $request->id,
            'business_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'user_type' => "required|in:user,vendor",
            'uid' => 'nullable|string|max:255',
            'fcm_token' => 'nullable|string|max:255',
            'image' => 'nullable|image',
            'year_of_establishment' => 'nullable|integer|digits:4',
            'gst_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'pincode' => 'nullable|integer|max:6',
            'business_email' => 'nullable|email',
            'type_of_business' => 'nullable|string|max:255',
            'name_of_partner_1' => 'nullable|string|max:255',
            'name_of_partner_2' => 'nullable|string|max:255',
            'phoneno_2' => 'nullable|integer|digits:10',
            'vendor_live_photo' => 'nullable|image',
            'business_live_photo' => 'nullable|image',
            'gst_certificate' => 'nullable|file',
            'partnersheep_deed' => 'nullable|file',
            'adharcard_one' => 'nullable|file',
            'adharcard_two' => 'nullable|file',
            'cancel_cheque' => 'nullable|file',
        ]);

        $user = User::find($request->id);
        $user->fill($validatedData);

        $fileUploads = [
            'image',
            'vendor_live_photo',
            'business_live_photo',
            'gst_certificate',
            'partnersheep_deed',
            'adharcard_one',
            'adharcard_two',
            'cancel_cheque'
        ];

        foreach ($fileUploads as $fileUpload) {
            if ($request->hasFile($fileUpload)) {
                if ($user->getRawOriginal($fileUpload)) {
                    $oldImagePath = str_replace('/storage', 'public', $user->getRawOriginal($fileUpload));
                    Storage::delete($oldImagePath);
                }
                $folder = $fileUpload == 'image' ? 'profile_images' : $fileUpload;
                $path = $request->file($fileUpload)->store("public/{$folder}");
                $user->$fileUpload = Storage::url($path);
            }
        }

        $user->update();

        return redirect()->route('manage-users',["type" => $user->user_type])->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();

        return response()->json(["message" => "User deleted successfully !"]);
    }

    public function changeStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->update();

        return response()->json(["message" => "Status updated successfully !"]);
    }

    public function profileApprove(Request $request){
        $vendor = User::where('user_type','vendor')->find($request->id);
        $vendor->vendor_status = $request->status;
        $vendor->update();

        return response()->json(["message" => "Status updated successfully !"]);
    }

    public function vendorProfileWebPage($id){
        try {
            $vendor = User::where([
                'user_type' => 'vendor',
                'id' => $id,
                'vendor_status' => "1",
                'status' => "1"
                ])->first();

            if (!$vendor) {
                return ResponseHelper::error('Vendor not found', 404);
            }

            $cars = CarDetail::where('user_id',$vendor->id)->where('publish_status',"publish")->get();
            return view('vendor-profile', compact('vendor','cars'));

        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
