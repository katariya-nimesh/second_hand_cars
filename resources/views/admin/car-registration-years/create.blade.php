@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h2>Create Car Registration Year</h2>
        <form class="car-form" action="{{ route('add-registration-years') }}" method="POST">
            @csrf
            <div>
                <label for="year">Year</label>
                <input type="number" id="year" name="year" required>
                @error('year')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="button">Create</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-registration-years') }}'">Cancel</button>
        </form>
    </div>
@endsection
