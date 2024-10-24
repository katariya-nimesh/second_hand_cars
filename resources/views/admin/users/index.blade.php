@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <div style="display: flex;justify-content: space-between;">
            <h2>All User</h2>

            <a href="{{ route('create-users', ['type' => 'user']) }}" class="button">Create New User</a>
            <a href="{{ route('admin.export.users') }}" class="button">Download Users Data</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>E mail</th>
                    <th>Location</th>
                    <th>Mobile No</th>
                    <th>Account Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->location }}</td>
                        <td>{{ $user->phoneno }}</td>
                        <td>
                            <select name="status" id="status"
                                class="status {{ $user->status == 1 ? 'active-status' : 'deactive-status' }}"
                                data-user-id="{{ $user->id }}">
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Activate</option>
                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Deactivate</option>
                            </select>
                        </td>
                        <td>
                            <select name="userAction" id="userAction" class="userAction actions"
                                data-user-id="{{ $user->id }}">
                                <option selected disabled value="">Select</option>
                                <option value="details">Details</option>
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
                    window.location.href = baseUrl + `/edit-users/${userId}`;
                } else if (action === 'details') {
                    window.location.href = baseUrl + `/details-users/${userId}`;
                } else if (action === 'delete') {
                    if (confirm('Are you sure you want to delete this user?')) {
                        $.ajax({
                            url: baseUrl + `/delete-users/${userId}`,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                location.reload()
                            },
                            error: function(xhr) {
                                alert('Failed to delete the user. Please try again.');
                            }
                        });
                    }
                }
                $(this).val('');
            });

            $('.status').on('change', function() {
                var action = $(this).val();
                var userId = $(this).data('user-id');

                if (action == 1) {
                    $(this).removeClass('deactive-status').addClass('active-status')
                } else {
                    $(this).removeClass('active-status').addClass('deactive-status')
                }

                $.ajax({
                    url: baseUrl + `/change-user-status`,
                    type: 'POST',
                    data: {
                        id: userId,
                        status: action,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // location.reload()
                    },
                    error: function(xhr) {
                        alert('Failed to delete the user. Please try again.');
                    }
                });

            });
        });
    </script>
@endsection
