@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Car Brand</h1>
    <form action="{{ route('car-brands.update', $carBrand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $carBrand->name) }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image">
            @error('image')
                <div>{{ $message }}</div>
            @enderror
            @if ($carBrand->image)
                <div>
                <img src="{{ $carBrand->image }}" alt="{{ $carBrand->name }}" width="100">
                </div>
            @endif
        </div>
        <button type="submit" class="button">Update</button>
    </form>
</div>
@endsection
