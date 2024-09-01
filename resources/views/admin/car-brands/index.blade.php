@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <div style="display: flex;justify-content: space-between;">
            <h2>Car Brands</h2>
            <a href="{{ route('create-brands') }}" class="button">Create New Car Brand</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carBrands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            @if ($brand->image)
                                <img src="{{ $brand->image }}" alt="{{ $brand->name }}" width="100" height="60">
                            @else
                                No image
                            @endif
                        </td>
                        <td>
                            <select name="userAction" id="userAction" class="userAction actions"
                                data-user-id="{{ $brand->id }}">
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
                    window.location.href = baseUrl + `/edit-brands/${userId}`;
                } else if (action === 'delete') {
                    if (confirm('Are you sure you want to delete this car brand?')) {
                        $.ajax({
                            url: baseUrl + `/delete-brands/${userId}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                location.reload()
                            },
                            error: function(xhr) {
                                alert('Failed to delete the car brand. Please try again.');
                            }
                        });
                    }
                }
                $(this).val('');
            });
        });
    </script>
@endsection
