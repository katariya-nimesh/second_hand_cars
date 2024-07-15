@extends('layouts.admin')

@section('content')
    <h2>Edit Car Registration Year</h2>

    <form action="{{ route('car-registration-years.update', $carRegistrationYear->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" value="{{ $carRegistrationYear->year }}" required>
        </div>
        <div>
            <label for="car_brand_id">Car Brand:</label>
            <select id="car_brand_id" name="car_brand_id" required>
                <option value="">Select Car Brand</option>
                @foreach($carBrands as $brand)
                    <option value="{{ $brand->id }}" {{ $carRegistrationYear->car_brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
