@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h1>Create Plan</h1>
        <form action="{{ route('add-plans') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-input-group">
                <div>
                    <label class="form-label" for="name">Name</label>
                </div>
                <div>
                    <input type="text" name="name" id="name" required>
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
                    <input type="number" min="0" name="total_cars" id="total_cars" required>
                    @error('total_cars')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-input-group">
                <div>
                    <label class="form-label" for="price">Price</label>
                </div>
                <div>
                    <input type="number" min="0" name="price" id="price" required>
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
                    <input type="text" name="description" id="description">
                    @error('description')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="button">Create</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-plans') }}'">Cancel</button>
        </form>
    </div>
@endsection
