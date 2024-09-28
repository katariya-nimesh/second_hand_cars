@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h1>Edit Plan</h1>

        <form action="{{ route('update-coupon-code') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <input type="text" hidden name="id" id="id" value="{{ $couponCode->id }}">

            <div class="form-input-group">
                <div>
                    <label class="form-label" for="code">Code</label>
                </div>
                <div>
                    <input type="text" name="code" id="code" value="{{ old('code', $couponCode->code) }}" required>
                    @error('code')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-input-group">
                <div>
                    <label class="form-label" for="discount">Discount</label>
                </div>
                <div>
                    <input type="number" min="0" name="discount" id="discount"
                        value="{{ old('discount', $couponCode->discount) }}" required>
                    @error('discount')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="button">Update</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-coupon-code') }}'">Cancel</button>
        </form>
    </div>
@endsection
