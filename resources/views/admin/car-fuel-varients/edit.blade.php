@extends('layouts.admin')

@section('content')
    <h2>Edit Car Fuel Varient</h2>

    <form action="{{ route('car-fuel-varients.update', $carFuelVarient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $carFuelVarient->name }}" required>
        </div>
        <div>
            <label for="car_fuel_type_id">Fuel Type:</label>
            <select id="car_fuel_type_id" name="car_fuel_type_id" required>
                <option value="">Select Fuel Type</option>
                @foreach($carFuelTypes as $fuelType)
                    <option value="{{ $fuelType->id }}" {{ $carFuelVarient->car_fuel_type_id == $fuelType->id ? 'selected' : '' }}>{{ $fuelType->fuel_type }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
