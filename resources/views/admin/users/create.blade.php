@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create User</h1>
    <form action="{{ route('add-users') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email">E mail</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="location">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}" required>
            @error('location')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="phoneno">Mobile No</label>
            <input type="number" name="phoneno" id="phoneno" value="{{ old('phoneno') }}" required>
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
