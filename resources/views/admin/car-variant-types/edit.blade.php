@extends('layouts.admin')

@section('content')
    <h2>Edit Car Variant Type</h2>

    <form action="{{ route('update-variant-types') }}" method="POST">
        @csrf
        @method('POST')
        <input type="text" hidden name="id" id="id" value="{{ $carVariantType->id }}">

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $carVariantType->name }}" required>
        </div>
        <div>
            <label for="car_brand_id">Car Brand:</label>
            <select id="car_brand_id" name="car_brand_id" required>
                <option value="">Select Car Brand</option>
                @foreach($carBrands as $brand)
                    <option value="{{ $brand->id }}" {{ $carVariantType->car_fuel_varient->car_fuel_type->car_varient->car_registration_year->car_brand->id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="car_registration_year_id">Registration Year:</label>
            <select id="car_registration_year_id" name="car_registration_year_id" required>
                <option value="">Select Registration Year</option>
                @foreach($yearSelect as $yearSelected)
                    <option value="{{ $yearSelected->id }}" {{ $carVariantType->car_fuel_varient->car_fuel_type->car_varient->car_registration_year->id == $yearSelected->id ? 'selected' : '' }}>{{ $yearSelected->year }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="car_variant_id">Car Variant:</label>
            <select id="car_variant_id" name="car_variant_id" required>
                <option value="">Select Car Variant</option>
                @foreach($variantSelect as $variantSelected)
                    <option value="{{ $variantSelected->id }}" {{ $carVariantType->car_fuel_varient->car_fuel_type->car_varient->id == $variantSelected->id ? 'selected' : '' }}>{{ $variantSelected->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="car_fuel_type_id">Fuel Type:</label>
            <select id="car_fuel_type_id" name="car_fuel_type_id" required>
                <option value="">Select Fuel Type</option>
                @foreach($fuelTypeSelect as $fuelTypeVariant)
                    <option value="{{ $fuelTypeVariant->id }}" {{ $carVariantType->car_fuel_varient->car_fuel_type->id == $fuelTypeVariant->id ? 'selected' : '' }}>{{ $fuelTypeVariant->fuel_type }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="car_fuel_varient_id">Fuel Variant:</label>
            <select id="car_fuel_varient_id" name="car_fuel_varient_id" required>
                <option value="">Select Fuel Variant</option>
                @foreach($carFuelVariants as $fuelVariant)
                    <option value="{{ $fuelVariant->id }}" {{ $carVariantType->car_fuel_varient_id == $fuelVariant->id ? 'selected' : '' }}>{{ $fuelVariant->name }}</option>
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
    const $fuelVarientSelect = $('#car_fuel_varient_id');

    var yearId = {{ $carVariantType->car_fuel_varient->car_fuel_type->car_varient->car_registration_year->id }};
    var variantId = {{ $carVariantType->car_fuel_varient->car_fuel_type->car_varient->id }};
    var fuelTypeId = {{ $carVariantType->car_fuel_varient->car_fuel_type->id }};

    $brandSelect.on('change', function() {
        const brandId = $(this).val();
        $.ajax({
            url: baseUrl + `/api/registration-years/${brandId}`,
            method: 'GET',
            success: function(data) {
                $yearSelect.html('<option value="">Select Registration Year</option>');
                data.forEach(year => {
                    $yearSelect.append(`<option value="${year.id}" ${year.id == yearId ? 'selected' : ''}>${year.year}</option>`);
                });
                $variantSelect.html('<option selected disabled value="">Select Car Variant</option>');
                $fuelTypeSelect.html('<option selected disabled value="">Select Fuel Type</option>');
                $fuelVarientSelect.html('<option selected disabled value="">Select Fuel Variant</option>');
            },
            error: function(error) {
                console.error('Error fetching registration years:', error);
            }
        });
    });

    $yearSelect.on('change', function() {
        const yearId = $(this).val();
        $.ajax({
            url: baseUrl + `/api/variants/${yearId}`,
            method: 'GET',
            success: function(data) {
                $variantSelect.html('<option value="">Select Car Variant</option>');
                data.forEach(variant => {
                    $variantSelect.append(`<option value="${variant.id}" ${variant.id == variantId ? 'selected' : ''}>${variant.name}</option>`);
                });
                $fuelTypeSelect.html('<option selected disabled value="">Select Fuel Type</option>');
                $fuelVarientSelect.html('<option selected disabled value="">Select Fuel Variant</option>');
            },
            error: function(error) {
                console.error('Error fetching car variants:', error);
            }
        });
    });

    $variantSelect.on('change', function() {
        const variantId = $(this).val();
        $.ajax({
            url: baseUrl + `/api/fueltypes/${variantId}`,
            method: 'GET',
            success: function(data) {
                $fuelTypeSelect.html('<option value="">Select Fuel Type</option>');
                data.forEach(fuelType => {
                    $fuelTypeSelect.append(`<option value="${fuelType.id}" ${fuelType.id == fuelTypeId ? 'selected' : ''}>${fuelType.fuel_type} - ${fuelType.transmission}</option>`);
                });
                $fuelVarientSelect.html('<option selected disabled value="">Select Fuel Variant</option>');

            },
            error: function(error) {
                console.error('Error fetching fuel types:', error);
            }
        });
    });

    $fuelTypeSelect.on('change', function() {
        const fueltypeId = $(this).val();
        $.ajax({
            url: baseUrl + `/api/fuelvarients/${fueltypeId}`,
            method: 'GET',
            success: function(data) {
                $fuelVarientSelect.html('<option value="">Select Fuel Type Varient</option>');
                data.forEach(fuelType => {
                    $fuelVarientSelect.append(`<option value="${fuelType.id}">${fuelType.name}</option>`);
                });
            },
            error: function(error) {
                console.error('Error fetching fuel type variants:', error);
            }
        });
    });
});

    </script>
@endsection
