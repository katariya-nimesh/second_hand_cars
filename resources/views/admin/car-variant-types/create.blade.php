@extends('layouts.admin')

@section('content')
    <h2>Create Car Variant Type</h2>

    <form action="{{ route('car-variant-types.store') }}" method="POST">
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

        <div>
            <label for="car_variant_id">Car Variant:</label>
            <select id="car_variant_id" name="car_variant_id" required>
                <option value="">Select Car Variant</option>
            </select>
        </div>
       
        <div>
            <label for="car_fuel_type_id">Fuel Type:</label>
            <select id="car_fuel_type_id" name="car_fuel_type_id" required>
                <option value="">Select Fuel Types</option>
            </select>
        </div>

        <div>
            <label for="car_fuel_varient_id">Fuel Variant:</label>
            <select id="car_fuel_varient_id" name="car_fuel_varient_id" required>
                <option value="">Select Fuel Variant</option>
                <!-- @foreach($carFuelVariants as $fuelVariant)
                    <option value="{{ $fuelVariant->id }}">{{ $fuelVariant->name }}</option>
                @endforeach -->
            </select>
        </div>
        <button type="submit">Create</button>
    </form>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const brandSelect = document.getElementById('car_brand_id');
    const yearSelect = document.getElementById('car_registration_year_id');
    const variantSelect = document.getElementById('car_variant_id');
    const fuelTypeSelect = document.getElementById('car_fuel_type_id');
    const fuelVarientSelect = document.getElementById('car_fuel_varient_id');

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
                    variantSelect.innerHTML += `<option value="${variant.id}">${variant.name}</option>`;
                });
            });
    });

    variantSelect.addEventListener('change', function() {
        const variantId = this.value;
        fetch(`/api/fueltypes/${variantId}`)
            .then(response => response.json())
            .then(data => {
                fuelTypeSelect.innerHTML = '<option value="">Select Fuel Type</option>';
                data.forEach(fuelType => {
                    fuelTypeSelect.innerHTML += `<option value="${fuelType.id}">${fuelType.fuel_type} - ${fuelType.transmission}</option>`;
                });
            })
            .catch(error => {
                console.error('Error fetching fuel types:', error); // Debugging line
            });
    });
    
    fuelTypeSelect.addEventListener('change', function() {
        const fueltypeId = this.value;
        fetch(`/api/fuelvarients/${fueltypeId}`)
            .then(response => response.json())
            .then(data => {
                fuelVarientSelect.innerHTML = '<option value="">Select Fuel Type Varient</option>';
                data.forEach(fuelType => {
                    fuelVarientSelect.innerHTML += `<option value="${fuelType.id}">${fuelType.name}</option>`;
                });
            })
            .catch(error => {
                console.error('Error fetching fuel types:', error); // Debugging line
            });
    });
});
    </script>
@endsection
