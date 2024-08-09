@extends('layouts.admin')

@section('content')
    <h2>Edit Car Fuel Variant</h2>

    <form action="{{ route('update-fuel-varients') }}" method="POST">
        @csrf
        @method('POST')
        <input type="text" hidden name="id" id="id" value="{{ $carFuelVarient->id }}">

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $carFuelVarient->name }}" required>
        </div>

        <div>
            <label for="car_brand_id">Car Brand:</label>
            <select id="car_brand_id" name="car_brand_id" required>
                {{-- <option value="" disabled>Select Car Brand</option> --}}
                @foreach($carBrands as $brand)
                    <option value="{{ $brand->id }}" {{ $carFuelVarient->car_fuel_type->car_varient->car_registration_year->car_brand->id == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="car_registration_year_id">Registration Year:</label>
            <select id="car_registration_year_id" name="car_registration_year_id" required>
                <option value="">Select Registration Year</option>
                @foreach($carRegistrationYears as $year)
                    <option value="{{ $year->id }}" {{ $carFuelVarient->car_fuel_type->car_varient->car_registration_year->id == $year->id ? 'selected' : '' }}>
                        {{ $year->year }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="car_variant_id">Car Variant:</label>
            <select id="car_variant_id" name="car_variant_id" required>
                <option value="">Select Car Variant</option>
                @foreach($carVariants as $variant)
                    <option value="{{ $variant->id }}" {{ $carFuelVarient->car_fuel_type->car_varient->id == $variant->id ? 'selected' : '' }}>
                        {{ $variant->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="car_fuel_type_id">Fuel Type:</label>
            <select id="car_fuel_type_id" name="car_fuel_type_id" required>
                <option value="">Select Fuel Type</option>
                @foreach($carFuelTypes as $fuelType)
                    <option value="{{ $fuelType->id }}" {{ $carFuelVarient->car_fuel_type->id == $fuelType->id ? 'selected' : '' }}>
                        {{ $fuelType->fuel_type }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Update</button>
    </form>

    <script>
       $(document).ready(function() {
        var baseUrl = '{{ url('/') }}';

    const $brandSelect = $('#car_brand_id');
    const $yearSelect = $('#car_registration_year_id');
    const $variantSelect = $('#car_variant_id');
    const $fuelTypeSelect = $('#car_fuel_type_id');

    $brandSelect.on('change', function() {
        const brandId = $(this).val();
        $.ajax({
            url: baseUrl + `/api/registration-years/${brandId}`,
            method: 'GET',
            success: function(data) {
                $yearSelect.html('<option selected disabled  value="">Select Registration Year</option>');
                data.forEach(year => {
                    $yearSelect.append(`<option value="${year.id}">${year.year}</option>`);
                });

                $variantSelect.html('<option selected disabled value="">Select Car Variant</option>');
                $fuelTypeSelect.html('<option selected disabled value="">Select Fuel Type</option>');
            }
        });
    });

    $yearSelect.on('change', function() {
        const yearId = $(this).val();
        $.ajax({
            url: baseUrl + `/api/variants/${yearId}`,
            method: 'GET',
            success: function(data) {
                $variantSelect.html('<option selected disabled value="">Select Car Variant</option>');
                data.forEach(variant => {
                    $variantSelect.append(`<option value="${variant.id}">${variant.name}</option>`);
                });
                $fuelTypeSelect.html('<option selected disabled value="">Select Fuel Type</option>');

            }
        });
    });

    $variantSelect.on('change', function() {
        const variantId = $(this).val();
        $.ajax({
            url: baseUrl + `/api/fueltypes/${variantId}`,
            method: 'GET',
            success: function(data) {
                $fuelTypeSelect.html('<option selected disabled value="">Select Fuel Type</option>');
                data.forEach(fuelType => {
                    $fuelTypeSelect.append(`<option value="${fuelType.id}">${fuelType.fuel_type}</option>`);
                });
            }
        });
    });

    // Trigger change events to populate fields based on selected options
    // $brandSelect.trigger('change');
    // $yearSelect.trigger('change');
    // $variantSelect.trigger('change');
});

    </script>
@endsection
