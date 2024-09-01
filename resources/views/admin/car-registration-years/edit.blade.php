@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h2>Edit Car Registration Year</h2>
        <form class="car-form" action="{{ route('update-registration-years') }}" method="POST">
            @csrf
            @method('POST')
            <input type="text" hidden name="id" id="id" value="{{ $carRegistrationYear->id }}">

            <div>
                <label for="year">Year</label>
                <input type="number" id="year" name="year" value="{{ old('year', $carRegistrationYear->year) }}"
                    required>
                @error('year')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="button">Update</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-registration-years') }}'">Cancel</button>
        </form>
    </div>
@endsection
