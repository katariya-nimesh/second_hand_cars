@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Car Vendor</h1>
    <form action="{{ route('update-vendors') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div>
            <input type="text" hidden name="id" id="id" value="{{ $vendor->id }}">

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $vendor->name) }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email">E mail</label>
            <input type="text" name="email" id="email" value="{{ old('email',$vendor->email) }}">
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="location">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location',$vendor->location) }}">
            @error('location')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="phoneno">Mobile No</label>
            <input type="text" name="phoneno" id="phoneno" value="{{ old('phoneno',$vendor->phoneno) }}">
            @error('phoneno')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="button">Update</button>
    </form>
</div>
@endsection
