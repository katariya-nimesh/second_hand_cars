@extends('layouts.admin')

@section('content')
    <h2>Create Car Fuel Type</h2>

    <form action="{{ route('car-fuel-types.store') }}" method="POST">
        @csrf
        <div>
            <label for="fuel_type">Fuel Type:</label>
            <input type="text" id="fuel_type" name="fuel_type" required>
        </div>
        <div>
            <label for="transmission">Transmission:</label>
            <input type="text" id="transmission" name="transmission" required>
        </div>
        <div>
            <label for="car_varient_id">Car Varient:</label>
            <select id="car_varient_id" name="car_varient_id" required>
                <option value="">Select Car Varient</option>
                @foreach($carVarients as $varient)
                    <option value="{{ $varient->id }}">{{ $varient->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
