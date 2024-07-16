@extends('layouts.admin')

@section('content')
    <h2>Edit Car Owner</h2>

    <form action="{{ route('car-owners.update', $carOwner->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $carOwner->name }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
