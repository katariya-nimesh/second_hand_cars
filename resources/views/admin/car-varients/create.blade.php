@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h2>Create Car Varient</h2>
        <form class="car-form" action="{{ route('add-varients') }}" method="POST">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
                @error('name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="car_brand_id">Car Brand</label>
                <select id="car_brand_id" name="car_brand_id" required>
                    <option selected disabled>Select Car Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                @error('car_brand_id')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="button">Create</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-varients') }}'">Cancel</button>
        </form>
    </div>
@endsection
