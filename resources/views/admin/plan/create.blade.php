@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Plan</h1>
    <form action="{{ route('add-plans') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="totalcars">Total Cars</label>
            <input type="number" min="0" name="totalcars" id="totalcars" value="{{ old('totalcars') }}" required>
            @error('totalcars')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" min="0" name="price" id="price" value="{{ old('price') }}" required>
            @error('price')
                <div>{{ $message }}</div>
            @enderror
        </div>
        {{-- <div>
            <label for="status">Account Status</label>
            <input type="text" name="status" id="status" value="{{ old('status') }}">
            @error('status')
                <div>{{ $message }}</div>
            @enderror
        </div> --}}
        <button type="submit" class="button">Create</button>
    </form>
</div>
@endsection
