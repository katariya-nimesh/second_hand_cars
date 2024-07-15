@extends('layouts.admin')

@section('content')
    <h1>Edit Car Brand</h1>
    <form class="form" action="{{ route('car-brands.update', $carBrand->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $carBrand->name) }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
