@extends('layouts.admin')

@section('content')
    <h2>Edit Car Kilometer Range</h2>

    <form action="{{ route('update-kilometers') }}" method="POST">
    @csrf
    @method('POST')
    <input type="text" hidden name="id" id="id" value="{{ $carKilometer->id }}">

    <label for="start_km">Start KM:</label>
    <input type="number" id="start_km" name="start_km" value="{{ old('start_km', $carKilometer->start_km) }}" required>
    <br>
    <label for="end_km">End KM:</label>
    <input type="number" id="end_km" name="end_km" value="{{ old('end_km', $carKilometer->end_km) }}" required>
    <br>
    @error('start_km')
        <div>{{ $message }}</div>
    @enderror
    @error('end_km')
        <div>{{ $message }}</div>
    @enderror
    <button type="submit">Update</button>
</form>
@endsection
