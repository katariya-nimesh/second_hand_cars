@extends('layouts.admin')

@section('content')
    <h2>Edit Car Fuel Variant</h2>

    <form action="{{ route('car-fuel-varients.update', $carFuelVarient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $carFuelVarient->name }}" required>
        </div>

        <div>
            <label for="car_brand_id">Car Brand:</label>
            <select id="car_brand_id" name="car_brand_id" required>
                <option value="">Select Car Brand</option>
                @foreach($carBrands as $brand)
                    <option value="{{ $brand->id }}" {{ $carFuelVarient->car_brand_id == $brand->id ? 'selected' : '' }}>
                        {{ $brand->brand_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="car_registration_year_id">Registration Year:</label>
            <select id="car_registration_year_id" name="car_registration_year_id" required>
                <option value="">Select Registration Year</option>
                @foreach($carRegistrationYears as $year)
                    <option value="{{ $year->id }}" {{ $carFuelVarient->car_registration_year_id == $year->id ? 'selected' : '' }}>
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
                    <option value="{{ $variant->id }}" {{ $carFuelVarient->car_variant_id == $variant->id ? 'selected' : '' }}>
                        {{ $variant->variant_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="car_fuel_type_id">Fuel Type:</label>
            <select id="car_fuel_type_id" name="car_fuel_type_id" required>
                <option value="">Select Fuel Type</option>
                @foreach($carFuelTypes as $fuelType)
                    <option value="{{ $fuelType->id }}" {{ $carFuelVarient->car_fuel_type_id == $fuelType->id ? 'selected' : '' }}>
                        {{ $fuelType->fuel_type }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Update</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const brandSelect = document.getElementById('car_brand_id');
            const yearSelect = document.getElementById('car_registration_year_id');
            const variantSelect = document.getElementById('car_variant_id');
            const fuelTypeSelect = document.getElementById('car_fuel_type_id');

            brandSelect.addEventListener('change', function() {
                const brandId = this.value;
                fetch(`/api/registration-years/${brandId}`)
                    .then(response => response.json())
                    .then(data => {
                        yearSelect.innerHTML = '<option value="">Select Registration Year</option>';
                        data.forEach(year => {
                            yearSelect.innerHTML += `<option value="${year.id}">${year.year}</option>`;
                        });
                    });
            });

            yearSelect.addEventListener('change', function() {
                const yearId = this.value;
                fetch(`/api/variants/${yearId}`)
                    .then(response => response.json())
                    .then(data => {
                        variantSelect.innerHTML = '<option value="">Select Car Variant</option>';
                        data.forEach(variant => {
                            variantSelect.innerHTML += `<option value="${variant.id}">${variant.variant_name}</option>`;
                        });
                    });
            });

            variantSelect.addEventListener('change', function() {
                const variantId = this.value;
                fetch(`/api/fuel-types/${variantId}`)
                    .then(response => response.json())
                    .then(data => {
                        fuelTypeSelect.innerHTML = '<option value="">Select Fuel Type</option>';
                        data.forEach(fuelType => {
                            fuelTypeSelect.innerHTML += `<option value="${fuelType.id}">${fuelType.fuel_type}</option>`;
                        });
                    });
            });

            // Trigger change event to populate fields based on selected options
            brandSelect.dispatchEvent(new Event('change'));
            yearSelect.dispatchEvent(new Event('change'));
            variantSelect.dispatchEvent(new Event('change'));
        });
    </script>
@endsection
