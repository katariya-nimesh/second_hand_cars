@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <div style="display: flex;justify-content: space-between;">
            <h2>Car Varients</h2>
            <a href="{{ route('create-varients') }}" class="button edit">Create New Car Varient</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carVarients as $varient)
                    <tr>
                        <td>{{ $varient->id }}</td>
                        <td>{{ $varient->name }}</td>
                        <td>
                            <select name="userAction" id="userAction" class="userAction actions"
                                data-user-id="{{ $varient->id }}">
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
                    window.location.href = baseUrl + `/edit-varients/${userId}`;
                } else if (action === 'delete') {
                    if (confirm('Are you sure you want to delete this car varient?')) {
                        $.ajax({
                            url: baseUrl + `/delete-varients/${userId}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                location.reload()
                            },
                            error: function(xhr) {
                                alert('Failed to delete the car varient. Please try again.');
                            }
                        });
                    }
                }
                $(this).val('');
            });
        });
    </script>
@endsection
