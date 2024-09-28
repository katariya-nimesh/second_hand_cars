@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h1>Create Coupon Code</h1>
        <form action="{{ route('add-coupon-code') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-input-group">
                <div>
                    <label class="form-label" for="code">Code</label>
                </div>
                <div>
                    <input type="text" name="code" id="code" required>
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
                    <input type="number" min="0" name="discount" id="discount" required>
                    @error('discount')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="button">Create</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-coupon-code') }}'">Cancel</button>
        </form>
    </div>
@endsection
