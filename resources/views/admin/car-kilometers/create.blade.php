@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h2>Create Car Kilometer Range</h2>
        <form class="car-form" action="{{ route('add-kilometers') }}" method="POST">
            @csrf
            <div>
                <label for="start_km">Start KM</label>
                <input type="number" id="start_km" name="start_km" value="{{ old('start_km') }}" required>
                @error('start_km')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="end_km">End KM</label>
                <input type="number" id="end_km" name="end_km" value="{{ old('end_km') }}" required>
                @error('end_km')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="button">Create</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-kilometers') }}'">Cancel</button>
        </form>
    </div>
@endsection
