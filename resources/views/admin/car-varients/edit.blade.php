@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h2>Edit Car Varient</h2>
        <form class="car-form" action="{{ route('update-varients') }}" method="POST">
            @csrf
            @method('POST')
            <input type="text" hidden name="id" id="id" value="{{ $carVarient->id }}">

            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $carVarient->name) }}" required>
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="car_brand_id">Car Brand:</label>
                <select id="car_brand_id" name="car_brand_id" required>
                    <option disabled selected>Select Car Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ $carVarient->car_brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                        </option>
                    @endforeach
                </select>
                @error('car_brand_id')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="button">Update</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-varients') }}'">Cancel</button>
        </form>
    </div>
@endsection
