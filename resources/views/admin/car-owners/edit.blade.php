@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h2>Edit Car Owner</h2>
        <form class="car-form" action="{{ route('update-owners') }}" method="POST">
            @csrf
            @method('POST')
            <input type="text" hidden name="id" id="id" value="{{ $carOwner->id }}">

            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $carOwner->name) }}" required>
                @error('name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="button">Update</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-owners') }}'">Cancel</button>
        </form>
    </div>
@endsection
