@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Plan</h1>
    <form action="{{ route('update-plans') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div>
            <input type="text" hidden name="id" id="id" value="{{ $plan->id }}">

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $plan->name) }}" required>
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="totalcars">Total Cars</label>
            <input type="number" min="0" name="totalcars" id="totalcars" value="{{ old('totalcars',$plan->total_cars) }}" required>
            @error('totalcars')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="location">Price</label>
            <input type="number" min="0" name="price" id="price" value="{{ old('price',$plan->price) }}" required>
            @error('price')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="button">Update</button>
    </form>
</div>
@endsection
