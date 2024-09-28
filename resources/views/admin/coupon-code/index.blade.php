@extends('layouts.admin')

@section('content')
    <div class="main-container">

        <div style="display: flex;justify-content: space-between;">
            <h2>All Coupon Code</h2>
            <a href="{{ route('create-coupon-code') }}" class="button">Create New Coupon Code</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($couponCode as $plan)
                    <tr>
                        <td>{{ $plan->code }}</td>
                        <td>{{ $plan->discount }}</td>
                        <td>
                            <select name="action" class="actions" id="actions" data-plan-id="{{ $plan->id }}">
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
            $('.actions').on('change', function() {
                var action = $(this).val();
                var planId = $(this).data('plan-id');

                if (action === 'edit') {
                    window.location.href = baseUrl + `/edit-coupon-code/${planId}`;
                } else if (action === 'delete') {
                    if (confirm('Are you sure you want to delete this plan?')) {
                        $.ajax({
                            url: baseUrl + `/delete-coupon-code/${planId}`,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                location.reload()
                            },
                            error: function(xhr) {
                                alert('Failed to delete the plan. Please try again.');
                            }
                        });
                    }
                }
                $(this).val('');
            });
        });
    </script>
@endsection
