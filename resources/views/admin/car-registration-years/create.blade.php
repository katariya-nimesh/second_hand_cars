@extends('layouts.admin')

@section('content')
    <h2>Create Car Registration Year</h2>

    <form action="{{ route('car-registration-years.store') }}" method="POST">
        @csrf
        <div>
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" required>
        </div>
        <div>
            <label for="car_brand_id">Car Brand:</label>
            <select id="car_brand_id" name="car_brand_id" required>
                <option value="">Select Car Brand</option>
                @foreach($carBrands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
