@extends('layouts.admin')

@section('content')
    <h2>Edit Car Variant Type</h2>

    <form action="{{ route('car-variant-types.update', $carVariantType->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $carVariantType->name }}" required>
        </div>
        <div>
            <label for="car_fuel_varient_id">Fuel Variant:</label>
            <select id="car_fuel_varient_id" name="car_fuel_varient_id" required>
                <option value="">Select Fuel Variant</option>
                @foreach($carFuelVariants as $fuelVariant)
                    <option value="{{ $fuelVariant->id }}" {{ $carVariantType->car_fuel_varient_id == $fuelVariant->id ? 'selected' : '' }}>{{ $fuelVariant->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
