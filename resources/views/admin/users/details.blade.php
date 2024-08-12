@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>User Details</h1>
    <form action="{{ route('add-users') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name</label>
            <input disabled type="text" name="name" id="name" value="{{ $user->name }}">
        </div>
        <div>
            <label for="email">E mail</label>
            <input disabled type="text" name="email" id="email" value="{{ $user->email }}">
        </div>
        <div>
            <label for="location">Location</label>
            <input disabled type="text" name="location" id="location" value="{{ $user->location }}">
        </div>
        <div>
            <label for="phoneno">Mobile No</label>
            <input disabled type="text" name="phoneno" id="phoneno" value="{{ $user->phoneno }}">
        </div>
        <div>
            <label for="status">Account Status</label>
            <input disabled type="text" name="status" id="status" value="{{ $user->status == 0 ? "Deactive" : "Active" }}">
        </div>
    </form>
</div>
@endsection
