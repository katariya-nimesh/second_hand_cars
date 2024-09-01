@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h1>{{ ucfirst($user->user_type) }} Details</h1>
        <form method="POST" enctype="multipart/form-data">

            <input disabled type="text" hidden name="id" id="id" value="{{ $user->id }}">

            <div class="form-input-group">
                <div>
                    <label for="name" class="form-label">Name</label>
                </div>
                <div>
                    <input disabled type="text" name="name" id="name" value="{{ $user->name }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="email" class="form-label">E mail</label>
                </div>
                <div>
                    <input disabled type="email" name="email" id="email" value="{{ $user->email }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="number" class="form-label">Mobile No</label>
                </div>
                <div>
                    <input disabled type="text" name="phoneno" id="phoneno" value="{{ $user->phoneno }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="business_name" class="form-label">Business Name</label>
                </div>
                <div>
                    <input disabled type="text" name="business_name" id="business_name" value="{{ $user->business_name }}"
                        >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="location" class="form-label">Location</label>
                </div>
                <div>
                    <input disabled type="text" name="location" id="location" value="{{ $user->location }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="uid" class="form-label">UID</label>
                </div>
                <div>
                    <input disabled type="text" name="uid" id="uid" value="{{ $user->uid }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="fcm_token" class="form-label">Fcm Token</label>
                </div>
                <div>
                    <input disabled type="text" name="fcm_token" id="fcm_token" value="{{ $user->fcm_token }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="image" class="form-label">Image</label>
                </div>
                <div>
                    <img src="{{ $user->image }}" alt="{{ $user->name ?? "User Photo" }}" width="300" height="150" style="color: #8D8D8D">
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="year_of_establishment" class="form-label">Year of Establishment</label>
                </div>
                <div>
                    <input disabled type="text" name="year_of_establishment" id="year_of_establishment"
                        value="{{ $user->year_of_establishment }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="gst_number" class="form-label">GST Number</label>
                </div>
                <div>
                    <input disabled type="text" name="gst_number" id="gst_number" value="{{ $user->gst_number }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="address" class="form-label">Address</label>
                </div>
                <div>
                    <input disabled type="text" name="address" id="address" value="{{ $user->address }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="city" class="form-label">City</label>
                </div>
                <div>
                    <input disabled type="text" name="city" id="city" value="{{ $user->city }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="state" class="form-label">State</label>
                </div>
                <div>
                    <input disabled type="text" name="state" id="state" value="{{ $user->state }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="pincode" class="form-label">Pincode</label>
                </div>
                <div>
                    <input disabled type="text" name="pincode" id="pincode" value="{{ $user->pincode }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="business_email" class="form-label">Business Email</label>
                </div>
                <div>
                    <input disabled type="text" name="business_email" id="business_email" value="{{ $user->business_email }}"
                        >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="type_of_business" class="form-label">Type of Business</label>
                </div>
                <div>
                    <input disabled type="text" name="type_of_business" id="type_of_business"
                        value="{{ $user->type_of_business }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="name_of_partner_1" class="form-label">Name of Partner 1</label>
                </div>
                <div>
                    <input disabled type="text" name="name_of_partner_1" id="name_of_partner_1"
                        value="{{ $user->name_of_partner_1 }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="name_of_partner_2" class="form-label">Name of Partner 2</label>
                </div>
                <div>
                    <input disabled type="text" name="name_of_partner_2" id="name_of_partner_2"
                        value="{{ $user->name_of_partner_2 }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="phoneno_2" class="form-label">Mobile No 2</label>
                </div>
                <div>
                    <input disabled type="text" name="phoneno_2" id="phoneno_2" value="{{ $user->phoneno_2 }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="vendor_live_photo" class="form-label">Vendor Live Photo</label>
                </div>
                <div>
                    <img src="{{ $user->vendor_live_photo }}" alt="Vendor Live Photo" width="300" height="150" style="color: #8D8D8D">
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="business_live_photo" class="form-label">Business Live Photo</label>
                </div>
                <div>
                    <img src="{{ $user->business_live_photo }}" alt="Business Live Photo" width="300" height="150" style="color: #8D8D8D">
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="gst_certificate" class="form-label">GST Certificate</label>
                </div>
                <div>
                    <input disabled type="text" name="gst_certificate" id="gst_certificate"
                        value="{{ basename($user->gst_certificate) }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="partnersheep_deed" class="form-label">Partnersheep Deed</label>
                </div>
                <div>
                    <input disabled type="text" name="partnersheep_deed" id="partnersheep_deed"
                        value="{{ basename($user->partnersheep_deed) }}" >
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="adharcard_one" class="form-label">Adharcard 1</label>
                </div>
                <div>
                    <input disabled type="text" name="adharcard_one" id="adharcard_one" value="{{ basename($user->adharcard_one) }}">
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="adharcard_two" class="form-label">Adharcard 2</label>
                </div>
                <div>
                    <input disabled type="text" name="adharcard_two" id="adharcard_two" value="{{ basename($user->adharcard_two) }}">
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="cancel_cheque" class="form-label">Cancel Cheque</label>
                </div>
                <div>
                    <input disabled type="text" name="cancel_cheque" id="cancel_cheque" value="{{ basename($user->cancel_cheque) }}">
                </div>
            </div>

            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-users', ['type' => $user->user_type]) }}'">Back</button>
        </form>
    </div>
@endsection
