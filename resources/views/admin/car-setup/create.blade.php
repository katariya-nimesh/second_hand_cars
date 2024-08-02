@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Create Car Setup</h2>
    <form action="{{ route('car-setup.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Car Brand -->
        <div class="form-group">
            <label for="brand_name">Car Brand Name</label>
            <input type="text" name="brand_name" id="brand_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="brand_image">Car Brand Image</label>
            <input type="file" name="brand_image" id="brand_image" class="form-control">
        </div>

        <!-- Registration Years -->
        <div id="registration-years">
            <h3>Registration Years</h3>
            <div class="registration-year" data-index="0">
                <div class="form-group">
                    <label for="registration_year_0">Year</label>
                    <input type="number" name="registration_years[0][year]" id="registration_year_0" class="form-control" required>
                </div>
                <button type="button" class="btn btn-danger remove-registration-year" style="display:none;">Remove Registration Year</button>

                <!-- Variants -->
                <div class="variants">
                    <h4>Variants</h4>
                    <div class="variant" data-index="0">
                        <div class="form-group">
                            <label for="variant_name_0_0">Variant Name</label>
                            <input type="text" name="registration_years[0][variants][0][name]" id="variant_name_0_0" class="form-control" required>
                        </div>
                        <button type="button" class="btn btn-danger remove-variant" style="display:none;">Remove Variant</button>

                        <!-- Fuel Types -->
                        <div class="fuel-types">
                            <h5>Fuel Types</h5>
                            <div class="fuel-type" data-index="0">
                                <div class="form-group">
                                    <label for="fuel_type_0_0_0">Fuel Type</label>
                                    <input type="text" name="registration_years[0][variants][0][fuel_types][0][fuel_type]" id="fuel_type_0_0_0" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="transmission_0_0_0">Transmission</label>
                                    <input type="text" name="registration_years[0][variants][0][fuel_types][0][transmission]" id="transmission_0_0_0" class="form-control" required>
                                </div>
                                <button type="button" class="btn btn-danger remove-fuel-type" style="display:none;">Remove Fuel Type</button>

                                <!-- Fuel Variants -->
                                <div class="fuel-variants">
                                    <h6>Fuel Variants</h6>
                                    <div class="fuel-variant" data-index="0">
                                        <div class="form-group">
                                            <label for="fuel_variant_name_0_0_0_0">Fuel Variant Name</label>
                                            <input type="text" name="registration_years[0][variants][0][fuel_types][0][fuel_variants][0][name]" id="fuel_variant_name_0_0_0_0" class="form-control" required>
                                        </div>
                                        <button type="button" class="btn btn-danger remove-fuel-variant" style="display:none;">Remove Fuel Variant</button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary add-fuel-variant">Add Fuel Variant</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary add-fuel-type">Add Fuel Type</button>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary add-variant">Add Variant</button>
            </div>
        </div>
        <button type="button" class="btn btn-secondary add-registration-year">Add Registration Year</button>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let registrationYearIndex = 0;
        let variantIndex = 0;
        let fuelTypeIndex = 0;
        let fuelVariantIndex = 0;

        document.querySelector('.add-registration-year').addEventListener('click', function () {
            registrationYearIndex++;
            const registrationYearTemplate = document.querySelector('.registration-year').cloneNode(true);
            registrationYearTemplate.setAttribute('data-index', registrationYearIndex);
            registrationYearTemplate.querySelectorAll('input').forEach(function (input) {
                const name = input.getAttribute('name');
                input.setAttribute('name', name.replace(/\d+/, registrationYearIndex));
                input.value = '';
            });
            registrationYearTemplate.querySelector('.remove-registration-year').style.display = 'block';
            document.getElementById('registration-years').appendChild(registrationYearTemplate);
        });

        document.querySelector('.add-variant').addEventListener('click', function () {
            variantIndex++;
            const variantTemplate = document.querySelector('.variant').cloneNode(true);
            variantTemplate.setAttribute('data-index', variantIndex);
            variantTemplate.querySelectorAll('input').forEach(function (input) {
                const name = input.getAttribute('name');
                input.setAttribute('name', name.replace(/\d+/, variantIndex));
                input.value = '';
            });
            variantTemplate.querySelector('.remove-variant').style.display = 'block';
            document.querySelector('.variants').appendChild(variantTemplate);
        });

        document.querySelector('.add-fuel-type').addEventListener('click', function () {
            fuelTypeIndex++;
            const fuelTypeTemplate = document.querySelector('.fuel-type').cloneNode(true);
            fuelTypeTemplate.setAttribute('data-index', fuelTypeIndex);
            fuelTypeTemplate.querySelectorAll('input').forEach(function (input) {
                const name = input.getAttribute('name');
                input.setAttribute('name', name.replace(/\d+/, fuelTypeIndex));
                input.value = '';
            });
            fuelTypeTemplate.querySelector('.remove-fuel-type').style.display = 'block';
            document.querySelector('.fuel-types').appendChild(fuelTypeTemplate);
        });

        document.querySelector('.add-fuel-variant').addEventListener('click', function () {
            fuelVariantIndex++;
            const fuelVariantTemplate = document.querySelector('.fuel-variant').cloneNode(true);
            fuelVariantTemplate.setAttribute('data-index', fuelVariantIndex);
            fuelVariantTemplate.querySelectorAll('input').forEach(function (input) {
                const name = input.getAttribute('name');
                input.setAttribute('name', name.replace(/\d+/, fuelVariantIndex));
                input.value = '';
            });
            fuelVariantTemplate.querySelector('.remove-fuel-variant').style.display = 'block';
            document.querySelector('.fuel-variants').appendChild(fuelVariantTemplate);
        });

        // Event delegation to handle remove buttons
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-registration-year')) {
                e.target.closest('.registration-year').remove();
            } else if (e.target.classList.contains('remove-variant')) {
                e.target.closest('.variant').remove();
            } else if (e.target.classList.contains('remove-fuel-type')) {
                e.target.closest('.fuel-type').remove();
            } else if (e.target.classList.contains('remove-fuel-variant')) {
                e.target.closest('.fuel-variant').remove();
            }
        });
    });
</script>
@endsection
