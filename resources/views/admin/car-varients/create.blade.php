@extends('layouts.admin')

@section('content')
    <h2>Create Car Varient</h2>

    <form action="{{ route('car-varients.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="car_brand_id">Car Brand:</label>
            <select id="car_brand_id" name="car_brand_id" required>
                <option value="">Select Car Brand</option>
                @foreach($carBrands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="car_registration_year_id">Registration Year:</label>
            <select id="car_registration_year_id" name="car_registration_year_id" required>
                <option value="">Select Registration Year</option>
            </select>
        </div>
        <button type="submit">Create</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#car_brand_id').on('change', function() {
                var carBrandId = $(this).val();
                $('#car_registration_year_id').empty();
                if (carBrandId) {
                    $.ajax({
                        url: '{{ route('car-varients.registration-years') }}',
                        type: 'GET',
                        data: { car_brand_id: carBrandId },
                        success: function(data) {
                            $('#car_registration_year_id').append('<option value="">Select Registration Year</option>');
                            $.each(data, function(key, value) {
                                $('#car_registration_year_id').append('<option value="' + value.id + '">' + value.year + '</option>');
                            });
                        }
                    });
                } else {
                    $('#car_registration_year_id').append('<option value="">Select Registration Year</option>');
                }
            });
        });
    </script>
@endsection
