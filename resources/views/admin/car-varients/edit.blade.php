@extends('layouts.admin')

@section('content')
    <h2>Edit Car Varient</h2>

    <form action="{{ route('update-varients') }}" method="POST">
        @csrf
        @method('POST')
        <input type="text" hidden name="id" id="id" value="{{ $carVarient->id }}">

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $carVarient->name }}" required>
        </div>
        <div>
            <label for="car_brand_id">Car Brand:</label>
            <select id="car_brand_id" name="car_brand_id" required>
                <option value="">Select Car Brand</option>
                @foreach($carBrands as $brand)
                    <option value="{{ $brand->id }}" {{ $carVarient->car_registration_year->car_brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="car_registration_year_id">Registration Year:</label>
            <select id="car_registration_year_id" name="car_registration_year_id" required>
                <option value="">Select Registration Year</option>
                @foreach($carRegistrationYears as $year)
                    <option value="{{ $year->id }}" {{ $carVarient->car_registration_year_id == $year->id ? 'selected' : '' }}>{{ $year->year }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load registration years when the page loads if a car brand is selected
            var initialCarBrandId = $('#car_brand_id').val();
            if (initialCarBrandId) {
                loadRegistrationYears(initialCarBrandId);
            }

            // Load registration years when the car brand changes
            $('#car_brand_id').on('change', function() {
                var carBrandId = $(this).val();
                loadRegistrationYears(carBrandId);
            });

            function loadRegistrationYears(carBrandId) {
                $('#car_registration_year_id').empty();
                if (carBrandId) {
                    $.ajax({
                        url: '{{ route('car-varients.registration-years') }}',
                        type: 'GET',
                        data: { car_brand_id: carBrandId },
                        success: function(data) {
                            $('#car_registration_year_id').append('<option value="">Select Registration Year</option>');
                            $.each(data, function(key, value) {
                                var selected = ({{ $carVarient->car_registration_year_id }} == value.id) ? 'selected' : '';
                                $('#car_registration_year_id').append('<option value="' + value.id + '" ' + selected + '>' + value.year + '</option>');
                            });
                        }
                    });
                } else {
                    $('#car_registration_year_id').append('<option value="">Select Registration Year</option>');
                }
            }
        });
    </script>
@endsection
