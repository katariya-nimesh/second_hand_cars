@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h2>Create Car Fuel Type</h2>
        <form class="car-form" action="{{ route('add-fuel-types') }}" method="POST">
            @csrf
            <div>
                <label for="fuel_type">Fuel Type</label>
                <input type="text" id="fuel_type" name="fuel_type" required>
                @error('fuel_type')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>
            {{-- <div>
                <label for="transmission">Transmission:</label>
                <select id="transmission" name="transmission" required>
                    <option value="Manual" selected>Manual</option>
                    <option value="Automatic">Automatic</option>
                </select>
            </div> --}}
            <button type="submit" class="button">Create</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-fuel-types') }}'">Cancel</button>
        </form>
    </div>
@endsection
