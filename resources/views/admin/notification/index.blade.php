@extends('layouts.admin')

@section('content')
    <div class="main-container">

        <div style="display: flex;justify-content: space-between;">
            <h2>Send Notification</h2>
        </div>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        <form action="{{ route('notifications.send') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-input-group">
                <div>
                    <label class="form-label" for="title">Title</label>
                </div>
                <div>
                    <input type="text" name="title" id="title" required>
                    @error('title')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-input-group">
                <div>
                    <label class="form-label" for="body">Body</label>
                </div>
                <div>
                    <input type="text" name="body" id="body" required>
                    @error('body')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label class="form-label" for="user_type">User Type</label>
                </div>
                <div>
                    <select name="user_type" id="user_type" >
                        <option disabled value="">Select</option>
                        <option value="user">Users</option>
                        <option value="vendor">Vendors</option>
                        <option value="both">Both</option>
                    </select>
                    @error('user_type')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="button">Send</button>
        </form>
    </div>
    <script>

    </script>
@endsection
