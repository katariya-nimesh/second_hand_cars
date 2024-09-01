@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h2>Create Car Fuel Variant</h2>
        <form class="car-form" action="{{ route('add-fuel-varients') }}" method="POST">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
                @error('name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="button">Create</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-fuel-varients') }}'">Cancel</button>
        </form>
    </div>
@endsection
