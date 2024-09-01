@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h2>Edit Car Fuel Type</h2>
        <form class="car-form" action="{{ route('update-fuel-types') }}" method="POST">
            @csrf
            @method('POST')
            <input type="text" hidden name="id" id="id" value="{{ $carFuelType->id }}">

            <div>
                <label for="fuel_type">Fuel Type</label>
                <input type="text" id="fuel_type" name="fuel_type" value="{{ old('fuel_type', $carFuelType->fuel_type) }}"
                    required>
                @error('fuel_type')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="button">Update</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-fuel-types') }}'">Cancel</button>
        </form>
    </div>
@endsection
