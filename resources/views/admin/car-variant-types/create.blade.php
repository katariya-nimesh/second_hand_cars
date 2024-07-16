@extends('layouts.admin')

@section('content')
    <h2>Create Car Variant Type</h2>

    <form action="{{ route('car-variant-types.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="car_fuel_varient_id">Fuel Variant:</label>
            <select id="car_fuel_varient_id" name="car_fuel_varient_id" required>
                <option value="">Select Fuel Variant</option>
                @foreach($carFuelVariants as $fuelVariant)
                    <option value="{{ $fuelVariant->id }}">{{ $fuelVariant->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
