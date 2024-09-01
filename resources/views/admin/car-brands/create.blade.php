@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h2>Create Car Brand</h2>
        <form class="car-form" action="{{ route('add-brands') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
                @error('name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="image">Image</label>
                <label for="image" class="custom-file-upload">
                    Choose File
                </label>
                <span id='val'>No file chosen</span>
                <input name="image" id="image" type="file" />
                @error('image')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="button">Create</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('dashboard') }}'">Cancel</button>
        </form>
    </div>
    <script>
        $("input[type='file']").change(function() {
            $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''))
        })
    </script>
@endsection
