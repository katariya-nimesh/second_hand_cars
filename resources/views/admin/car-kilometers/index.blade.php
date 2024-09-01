@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <div style="display: flex;justify-content: space-between;">
            <h2>Car Kilometer Ranges</h2>
            <a href="{{ route('create-kilometers') }}" class="button">Create New Range</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Start Kilometer</th>
                    <th>End Kilometer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carKilometers as $carKilometer)
                    <tr>
                        <td>{{ $carKilometer->id }}</td>
                        <td>{{ $carKilometer->start_km }}</td>
                        <td>{{ $carKilometer->end_km }}</td>
                        <td>
                            <select name="userAction" id="userAction" class="userAction actions"
                                data-user-id="{{ $carKilometer->id }}">
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
                    window.location.href = baseUrl + `/edit-kilometers/${userId}`;
                } else if (action === 'delete') {
                    if (confirm('Are you sure you want to delete this kilometer range?')) {
                        $.ajax({
                            url: baseUrl + `/delete-kilometers/${userId}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                location.reload()
                            },
                            error: function(xhr) {
                                alert(
                                'Failed to delete the kilometer range. Please try again.');
                            }
                        });
                    }
                }
                $(this).val('');
            });
        });
    </script>
@endsection
