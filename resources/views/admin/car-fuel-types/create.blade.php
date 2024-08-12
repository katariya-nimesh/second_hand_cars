@extends('layouts.admin')

@section('content')
    <h2>Create Car Fuel Type</h2>

    <form action="{{ route('add-fuel-types') }}" method="POST">
        @csrf
        <div>
            <label for="fuel_type">Fuel Type:</label>
            <input type="text" id="fuel_type" name="fuel_type" required>
        </div>
        <div>
            <label for="transmission">Transmission:</label>
            {{-- <input type="text" id="transmission" name="transmission" required> --}}
            <select id="transmission" name="transmission" required>
                <option value="Manual" selected>Manual</option>
                <option value="Automatic">Automatic</option>
            </select>
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
        <div>
            <label for="car_varient_id">Car Variant:</label>
            <select id="car_varient_id" name="car_varient_id" required>
                <option value="">Select Car Variant</option>
            </select>
            @error('car_varient_id')
            <div>{{ $message }}</div>
        @enderror
        </div>
        <button type="submit">Create</button>
    </form>

    <script>
        var baseUrl = '{{ url('/') }}';
        $('#car_brand_id').on('change', function() {
    var brandId = $(this).val();
    $.ajax({
        url: baseUrl + `/api/get-registration-years`,
        data: { car_brand_id: brandId },
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var yearSelect = $('#car_registration_year_id');
            yearSelect.html('<option value="">Select Registration Year</option>');
            $.each(data, function(index, year) {
                yearSelect.append(`<option value="${year.id}">${year.year}</option>`);
            });
            $('#car_varient_id').html('<option selected disabled value="">Select Car Variant</option>');

        }
    });
});

$('#car_registration_year_id').on('change', function() {
    var yearId = $(this).val();
    $.ajax({
        url: baseUrl + `/api/get-variants`,
        data: { car_registration_year_id: yearId },
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var variantSelect = $('#car_varient_id');
            variantSelect.html('<option value="">Select Car Variant</option>');
            $.each(data, function(index, variant) {
                variantSelect.append(`<option value="${variant.id}">${variant.name}</option>`);
            });
        }
    });
});

    </script>
@endsection
