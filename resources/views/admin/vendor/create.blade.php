@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Vendor</h1>
    <form action="{{ route('add-vendors') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email">E mail</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="location">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}">
            @error('location')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="phoneno">Mobile No</label>
            <input type="text" name="phoneno" id="phoneno" value="{{ old('phoneno') }}">
            @error('phoneno')
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
