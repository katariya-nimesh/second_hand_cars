@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h1>Edit Vendor</h1>

        <form action="{{ route('update-vendors') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <input type="text" hidden name="id" id="id" value="{{ $vendor->id }}">

            <div class="form-input-group">
                <label class="form-label" for="name">Name:</label>
                <div>
                    <input type="text" name="name" id="name" value="{{ old('name', $vendor->name) }}" required>
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <label class="form-label" for="email">E mail</label>
                <div>
                    <input type="text" name="email" id="email" value="{{ old('email', $vendor->email) }}" required>
                    @error('email')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <label class="form-label" for="location">Location</label>
                <div>
                    <input type="text" name="location" id="location" value="{{ old('location', $vendor->location) }}"
                        required>
                    @error('location')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <label class="form-label" for="phoneno">Mobile No</label>
                <div>
                    <input type="text" name="phoneno" id="phoneno" value="{{ old('phoneno', $vendor->phoneno) }}"
                        required>
                    @error('phoneno')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="button">Update</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-vendors') }}'">Cancel</button>
        </form>
    </div>
@endsection
