@extends('layouts.admin')

@section('content')
    <h2>Edit Car Registration Year</h2>

    <form action="{{ route('update-registration-years') }}" method="POST">
        @csrf
        @method('POST')
        <input type="text" hidden name="id" id="id" value="{{ $carRegistrationYear->id }}">

        <div>
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" value="{{ $carRegistrationYear->year }}" required>
            @error('year')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="car_brand_id">Car Brand:</label>
            <select id="car_brand_id" name="car_brand_id" required>
                <option value="">Select Car Brand</option>
                @foreach ($carBrands as $brand)
                    <option value="{{ $brand->id }}"
                        {{ $carRegistrationYear->car_brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
