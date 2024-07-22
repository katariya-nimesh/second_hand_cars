@extends('layouts.admin')

@section('content')
    <h2>Edit Car Varient</h2>

    <form action="{{ route('car-varients.update', $carVarient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $carVarient->name }}" required>
        </div>
        <div>
            <label for="car_registration_year_id">Registration Year:</label>
            <select id="car_registration_year_id" name="car_registration_year_id" required>
                <option value="">Select Registration Year</option>
                @foreach($carRegistrationYears as $year)
                    <option value="{{ $year->id }}" {{ $carVarient->car_registration_year_id == $year->id ? 'selected' : '' }}>{{ $year->year }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
