@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h1>Plan Details</h1>
        <form action="{{ route('add-users') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-input-group">
                <div>
                    <label class="form-label" for="name">Name</label>
                </div>
                <input disabled type="text" name="name" id="name" value="{{ $plan->name }}">
            </div>
            <div class="form-input-group">
                <div>
                    <label class="form-label" for="totalcars">Total Cars</label>
                </div>
                <input disabled type="text" name="totalcars" id="totalcars" value="{{ $plan->total_cars }}">
            </div>
            <div class="form-input-group">
                <div>
                    <label class="form-label" for="price">Price</label>
                </div>
                <input disabled type="text" name="price" id="price" value="{{ $plan->price }}">
            </div>
            <div class="form-input-group">
                <div>
                    <label class="form-label" for="status">Account Status</label>
                </div>
                <input disabled type="text" name="status" id="status"
                    value="{{ $plan->status == 0 ? 'Deactive' : 'Active' }}">
            </div>
            <div class="form-input-group">
                <div>
                    <label class="form-label" for="description">Description</label>
                </div>
                <input disabled type="text" name="description" id="description" value="{{ $plan->description }}">
            </div>

            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-plans') }}'">Back</button>
        </form>
    </div>
@endsection
