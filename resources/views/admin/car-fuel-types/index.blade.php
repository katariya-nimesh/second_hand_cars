@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <div style="display: flex;justify-content: space-between;">
            <h2>Car Fuel Types</h2>
            <a href="{{ route('create-fuel-types') }}" class="button edit">Create New Car Fuel Type</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fuel Type</th>
                    {{-- <th>Transmission</th> --}}
                    {{-- <th>Car Varient</th> --}}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carFuelTypes as $fuelType)
                    <tr>
                        <td>{{ $fuelType->id }}</td>
                        <td>{{ $fuelType->fuel_type }}</td>
                        {{-- <td>{{ $fuelType->transmission }}</td> --}}
                        {{-- <td>{{ optional($fuelType->car_varient)->name ?? 'N/A' }}</td> --}}
                        <td>
                            <select name="userAction" id="userAction" class="userAction actions"
                                data-user-id="{{ $fuelType->id }}">
                                <option selected disabled value="">Select</option>
                                <option value="edit">Edit</option>
                                <option value="delete">Delete</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            var baseUrl = '{{ url('/') }}';
            $('.userAction').on('change', function() {
                var action = $(this).val();
                var userId = $(this).data('user-id');

                if (action === 'edit') {
                    window.location.href = baseUrl + `/edit-fuel-types/${userId}`;
                } else if (action === 'delete') {
                    if (confirm('Are you sure you want to delete this fuel type?')) {
                        $.ajax({
                            url: baseUrl + `/delete-fuel-types/${userId}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                location.reload()
                            },
                            error: function(xhr) {
                                alert(
                                    'Failed to delete the fuel type. Please try again.');
                            }
                        });
                    }
                }
                $(this).val('');
            });
        });
    </script>
@endsection
