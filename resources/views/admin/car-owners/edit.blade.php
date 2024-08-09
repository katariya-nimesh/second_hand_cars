@extends('layouts.admin')

@section('content')
    <h2>Edit Car Owner</h2>

    <form action="{{ route('update-owners') }}" method="POST">
        @csrf
        @method('POST')
        <input type="text" hidden name="id" id="id" value="{{ $carOwner->id }}">

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $carOwner->name }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
