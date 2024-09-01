@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h1>Edit Plan</h1>

        <form action="{{ route('update-plans') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <input type="text" hidden name="id" id="id" value="{{ $plan->id }}">

            <div class="form-input-group">
                <div>
                    <label class="form-label" for="name">Name</label>
                </div>
                <div>
                    <input type="text" name="name" id="name" value="{{ old('name', $plan->name) }}" required>
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-input-group">
                <div>
                    <label class="form-label" for="total_cars">Total Cars</label>
                </div>
                <div>
                    <input type="number" min="0" name="total_cars" id="total_cars"
                        value="{{ old('total_cars', $plan->total_cars) }}" required>
                    @error('total_cars')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-input-group">
                <div>
                    <label class="form-label" for="location">Price</label>
                </div>
                <div>
                    <input type="number" min="0" name="price" id="price"
                        value="{{ old('price', $plan->price) }}" required>
                    @error('price')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-input-group">
                <div>
                    <label class="form-label" for="description">Description</label>
                </div>
                <div>
                    <input type="text" name="description" id="description"
                        value="{{ old('description', $plan->description) }}">
                    @error('description')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="button">Update</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-plans') }}'">Cancel</button>
        </form>
    </div>
@endsection
