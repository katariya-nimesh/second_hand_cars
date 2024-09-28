<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CouponCode;


class CouponCodeController extends Controller
{
    public function index()
    {
        $couponCode = CouponCode::all();
        return view('admin.coupon-code.index', compact('couponCode'));
    }

    public function create()
    {
        return view('admin.coupon-code.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'          => 'required|string|max:255|unique:coupon_codes,code',
            'discount'    => 'required|min:0',
        ]);

        CouponCode::create($request->all());

        return redirect()->route('manage-coupon-code')->with('success', 'Coupon created successfully.');
    }

    public function edit($id)
    {
        $couponCode = CouponCode::find($id);
        return view('admin.coupon-code.edit', compact('couponCode'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'code'          => 'required|string|max:255|unique:coupon_codes,code,' . $request->id,
            'discount'    => 'required|min:0'
        ]);

        $couponCode = CouponCode::find($request->id);
        $couponCode->fill($request->all());

        $couponCode->save();

        return redirect()->route('manage-coupon-code')->with('success', 'Coupon updated successfully.');
    }

    public function destroy($id)
    {
        $couponCode = CouponCode::find($id)->delete();

        return redirect()->route('manage-coupon-code')->with('success', 'Coupon deleted successfully.');
    }
}
