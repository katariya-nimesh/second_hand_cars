@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Plan Details</h1>
    <form action="{{ route('add-users') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name</label>
            <input disabled type="text" name="name" id="name" value="{{ $plan->name }}">
        </div>
        <div>
            <label for="totalcars">Total Cars</label>
            <input disabled type="text" name="totalcars" id="totalcars" value="{{ $plan->total_cars }}">
        </div>
        <div>
            <label for="price">Price</label>
            <input disabled type="text" name="price" id="price" value="{{ $plan->price }}">
        </div>
        <div>
            <label for="status">Account Status</label>
            <input disabled type="text" name="status" id="status" value="{{ $plan->status == 0 ? "Deactive" : "Active" }}">
        </div>
    </form>
</div>
@endsection
