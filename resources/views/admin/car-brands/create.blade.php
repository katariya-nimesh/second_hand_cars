@extends('layouts.admin')

@section('content')
    <h1>Create Car Brand</h1>
    <form class="form" action="{{ route('car-brands.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
