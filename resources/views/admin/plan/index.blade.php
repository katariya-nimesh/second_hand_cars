@extends('layouts.admin')

@section('content')
    <div style="display: flex;justify-content: space-between;">
        <h2>All Plans</h2>
        <a style="padding: 12px 10px;margin: 12px;background-color:#4476FB; text-decoration:none;font-size: small;border-radius: 8px;"
            href="{{ route('create-plans') }}" class="button">Create New PLan</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Total Cars</th>
                <th>Price</th>
                <th>Account Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($plans as $plan)
                <tr>
                    <td>{{ $plan->name }}</td>
                    <td>{{ $plan->total_cars }}</td>
                    <td>{{ $plan->price }}</td>
                    <td>
                        <select name="status" id="status" class="status" data-plan-id="{{ $plan->id }}">
                            <option value="1" {{ $plan->status == 1 ? 'selected' : '' }}>Activate</option>
                            <option value="0" {{ $plan->status == 0 ? 'selected' : '' }}>Deactivate</option>
                        </select>
                    </td>
                    <td>
                        <select name="action" class="action" id="action" data-plan-id="{{ $plan->id }}">
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
    <script>
        $(document).ready(function() {
            var baseUrl = '{{ url('/') }}';
            $('.action').on('change', function() {
                var action = $(this).val();
                var planId = $(this).data('plan-id');

                if (action === 'edit') {
                    window.location.href = baseUrl + `/edit-plans/${planId}`;
                } else if (action === 'details') {
                    window.location.href = baseUrl + `/details-plans/${planId}`;
                } else if (action === 'delete') {
                    if (confirm('Are you sure you want to delete this user?')) {
                        $.ajax({
                            url: baseUrl + `/delete-plans/${planId}`,
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
                var planId = $(this).data('plan-id');

                $.ajax({
                    url: baseUrl + `/change-plan-status`,
                    type: 'POST',
                    data: {
                        id: planId,
                        status: action,
                        // _method: 'POST',
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
