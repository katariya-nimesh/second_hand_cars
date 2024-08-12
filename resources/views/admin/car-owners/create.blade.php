@extends('layouts.admin')

@section('content')
    <h2>Create Car Owner</h2>

    <form action="{{ route('add-owners') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
