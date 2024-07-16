@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Car Brand</h1>
    <form action="{{ route('car-brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
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
        </div>
        <button type="submit" class="button">Create</button>
    </form>
</div>
@endsection
