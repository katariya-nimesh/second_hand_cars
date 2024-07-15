@extends('layouts.admin')

@section('content')
    <h2>Edit Car Fuel Type</h2>

    <form action="{{ route('car-fuel-types.update', $carFuelType->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="fuel_type">Fuel Type:</label>
            <input type="text" id="fuel_type" name="fuel_type" value="{{ $carFuelType->fuel_type }}" required>
        </div>
        <div>
            <label for="transmission">Transmission:</label>
            <input type="text" id="transmission" name="transmission" value="{{ $carFuelType->transmission }}" required>
        </div>
        <div>
            <label for="car_varient_id">Car Varient:</label>
            <select id="car_varient_id" name="car_varient_id" required>
                <option value="">Select Car Varient</option>
                @foreach($carVarients as $varient)
                    <option value="{{ $varient->id }}" {{ $carFuelType->car_varient_id == $varient->id ? 'selected' : '' }}>{{ $varient->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
