@extends('layouts.admin')

@section('content')
    <h2>Edit Car Fuel Type</h2>

    <form action="{{ route('car-fuel-types.update', $carFuelType->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="fuel_type">Fuel Type:</label>
            <input type="text" id="fuel_type" name="fuel_type" value="{{ $carFuelType->fuel_type }}" required>
        </div>
        <div>
            <label for="transmission">Transmission:</label>
            <input type="text" id="transmission" name="transmission" value="{{ $carFuelType->transmission }}" required>
        </div>
        <div>
            <label for="car_brand_id">Car Brand:</label>
            <select id="car_brand_id" name="car_brand_id" required>
                <option value="">Select Car Brand</option>
                @foreach($carBrands as $brand)
                    <option value="{{ $brand->id }}" {{ $carFuelType->car_varient->car_registration_year->car_brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
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
        </div>
        <button type="submit">Update</button>
    </form>

    <script>
        document.getElementById('car_brand_id').addEventListener('change', function() {
            var brandId = this.value;
            fetch(`/api/get-registration-years?car_brand_id=${brandId}`)
                .then(response => response.json())
                .then(data => {
                    var yearSelect = document.getElementById('car_registration_year_id');
                    yearSelect.innerHTML = '<option value="">Select Registration Year</option>';
                    data.forEach(function(year) {
                        yearSelect.innerHTML += `<option value="${year.id}">${year.year}</option>`;
                    });
                });
        });

        document.getElementById('car_registration_year_id').addEventListener('change', function() {
            var yearId = this.value;
            fetch(`/api/get-variants?car_registration_year_id=${yearId}`)
                .then(response => response.json())
                .then(data => {
                    var variantSelect = document.getElementById('car_varient_id');
                    variantSelect.innerHTML = '<option value="">Select Car Variant</option>';
                    data.forEach(function(variant) {
                        variantSelect.innerHTML += `<option value="${variant.id}">${variant.name}</option>`;
                    });
                });
        });

        // Pre-populate year and variant select fields if editing
        document.addEventListener('DOMContentLoaded', function() {
            var brandId = document.getElementById('car_brand_id').value;
            var yearId = {{ $carFuelType->car_varient->car_registration_year_id }};
            var variantId = {{ $carFuelType->car_varient_id }};

            if (brandId) {
                fetch(`/api/get-registration-years?car_brand_id=${brandId}`)
                    .then(response => response.json())
                    .then(data => {
                        var yearSelect = document.getElementById('car_registration_year_id');
                        yearSelect.innerHTML = '<option value="">Select Registration Year</option>';
                        data.forEach(function(year) {
                            yearSelect.innerHTML += `<option value="${year.id}" ${year.id == yearId ? 'selected' : ''}>${year.year}</option>`;
                        });
                    });
            }

            if (yearId) {
                fetch(`/api/get-variants?car_registration_year_id=${yearId}`)
                    .then(response => response.json())
                    .then(data => {
                        var variantSelect = document.getElementById('car_varient_id');
                        variantSelect.innerHTML = '<option value="">Select Car Variant</option>';
                        data.forEach(function(variant) {
                            variantSelect.innerHTML += `<option value="${variant.id}" ${variant.id == variantId ? 'selected' : ''}>${variant.name}</option>`;
                        });
                    });
            }
        });
    </script>
@endsection
