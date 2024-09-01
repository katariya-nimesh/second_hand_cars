@extends('layouts.admin')

@section('style')
    <style>
        .approve {
            background-color: #62C57E;
            padding: 8px 10px;
            margin: 2px;
            text-decoration: none;
            font-size: small;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            color: #ffffff
        }

        .decline {
            background-color: #c56262;
            padding: 8px 10px;
            margin: 2px;
            text-decoration: none;
            font-size: small;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            color: #ffffff
        }
    </style>
@endsection

@section('content')
    <div class="main-container">
        <div style="display: flex;justify-content: space-between;">
            <h2>All Vendor</h2>
            <a href="{{ route('create-users',["type" => 'vendor']) }}" class="button">Create New Vendor</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>E mail</th>
                    <th>Location</th>
                    <th>Mobile No</th>
                    <th>Created Time</th>
                    <th>Approve Status</th>
                    <th>Account Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendors as $vendor)
                    <tr>
                        <td>{{ $vendor->name }}</td>
                        <td>{{ $vendor->email }}</td>
                        <td>{{ $vendor->location }}</td>
                        <td>{{ $vendor->phoneno }}</td>
                        <td>{{  \Carbon\Carbon::parse($vendor->created_at)->diffForHumans() }}</td>
                        <td>
                            @if ($vendor->vendor_status == 2)
                                <button class="approve verification" data-user-id="{{ $vendor->id }}"
                                    value="1">Approve</button>
                                <button class="decline verification" data-user-id="{{ $vendor->id }}"
                                    value="0">Decline</button>
                            @else
                                {{ $vendor->vendor_status == 1 ? 'Approved' : 'Decline' }}
                            @endif
                        </td>
                        <td>
                            <select name="status" id="status"
                                class="status {{ $vendor->status == 1 ? 'active-status' : 'deactive-status' }}"
                                data-user-id="{{ $vendor->id }}">
                                <option value="1" {{ $vendor->status == 1 ? 'selected' : '' }}>Activate</option>
                                <option value="0" {{ $vendor->status == 0 ? 'selected' : '' }}>Deactivate</option>
                            </select>
                        </td>
                        <td>
                            <select name="action" id="action" class="actions" data-user-id="{{ $vendor->id }}">
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
            $('.actions').on('change', function() {
                var action = $(this).val();
                var userId = $(this).data('user-id');

                if (action === 'edit') {
                    window.location.href = baseUrl + `/edit-users/${userId}`;
                } else if (action === 'details') {
                    window.location.href = baseUrl + `/details-users/${userId}`;
                } else if (action === 'delete') {
                    if (confirm('Are you sure you want to delete this vendor?')) {
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
                                alert('Failed to delete the vendor. Please try again.');
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
                        // _method: 'POST',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // location.reload()
                    },
                    error: function(xhr) {
                        alert('Failed to delete the vendor. Please try again.');
                    }
                });

            });

            $('.verification').on('click', function() {
                var action = $(this).val();
                var userId = $(this).data('user-id');

                $.ajax({
                    url: baseUrl + `/profile-approve`,
                    type: 'POST',
                    data: {
                        id: userId,
                        status: action,
                        // _method: 'POST',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        location.reload()
                    },
                    error: function(xhr) {
                        alert('Failed to delete the vendor. Please try again.');
                    }
                });

            });
        });
    </script>
@endsection
