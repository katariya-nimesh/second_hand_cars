@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h1>Vendor Details</h1>
        <form action="{{ route('add-vendors') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-input-group">
                <label class="form-label" for="name">Name</label>
                <input disabled type="text" name="name" id="name" value="{{ $vendor->name }}">
            </div>
            <div class="form-input-group">
                <label class="form-label" for="email">E mail</label>
                <input disabled type="text" name="email" id="email" value="{{ $vendor->email }}">
            </div>
            <div class="form-input-group">
                <label class="form-label" for="location">Location</label>
                <input disabled type="text" name="location" id="location" value="{{ $vendor->location }}">
            </div>
            <div class="form-input-group">
                <label class="form-label" for="phoneno">Mobile No</label>
                <input disabled type="text" name="phoneno" id="phoneno" value="{{ $vendor->phoneno }}">
            </div>
            <div class="form-input-group">
                <label class="form-label" for="status">Account Status</label>
                <input disabled type="text" name="status" id="status"
                    value="{{ $vendor->status == 0 ? 'Deactive' : 'Active' }}">
            </div>

            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-vendors') }}'">Back</button>
        </form>
    </div>
@endsection
