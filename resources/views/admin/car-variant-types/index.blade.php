@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <div style="display: flex;justify-content: space-between;">
            <h2>Car Variant Types</h2>
            <a href="{{ route('create-variant-types') }}" class="button edit">Create New Car Variant Type</a>
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
                @foreach ($carVariantTypes as $variantType)
                    <tr>
                        <td>{{ $variantType->id }}</td>
                        <td>{{ $variantType->name }}</td>
                        <td>
                            <select name="userAction" id="userAction" class="userAction actions"
                                data-user-id="{{ $variantType->id }}">
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
                    window.location.href = baseUrl + `/edit-variant-types/${userId}`;
                } else if (action === 'delete') {
                    if (confirm('Are you sure you want to delete this car varient type?')) {
                        $.ajax({
                            url: baseUrl + `/delete-variant-types/${userId}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                location.reload()
                            },
                            error: function(xhr) {
                                alert(
                                    'Failed to delete the car varient type. Please try again.'
                                    );
                            }
                        });
                    }
                }
                $(this).val('');
            });
        });
    </script>
@endsection
