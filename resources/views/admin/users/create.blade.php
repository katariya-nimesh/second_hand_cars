@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <h1>Create {{ ucfirst($type) }}</h1>
        <form action="{{ route('add-users') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" hidden name="user_type" id="user_type" value="{{ $type }}">

            <div class="form-input-group">
                <div>
                    <label for="name" class="form-label">Name</label>
                </div>
                <div>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="email" class="form-label">E mail</label>
                </div>
                <div>
                    <input type="email" name="email" id="email" value="{{ old('email') }}">
                    @error('email')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="number" class="form-label">Mobile No</label>
                </div>
                <div>
                    <input type="text" name="phoneno" id="phoneno" value="{{ old('phoneno') }}" required>
                    @error('phoneno')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="business_name" class="form-label">Business Name</label>
                </div>
                <div>
                    <input type="text" name="business_name" id="business_name" value="{{ old('business_name') }}">
                    @error('business_name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="location" class="form-label">Location</label>
                </div>
                <div>
                    <input type="text" name="location" id="location" value="{{ old('location') }}">
                    @error('location')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="uid" class="form-label">UID</label>
                </div>
                <div>
                    <input type="text" name="uid" id="uid" value="{{ old('uid') }}">
                    @error('uid')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="fcm_token" class="form-label">Fcm Token</label>
                </div>
                <div>
                    <input type="text" name="fcm_token" id="fcm_token" value="{{ old('fcm_token') }}">
                    @error('fcm_token')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="image" class="form-label">Image</label>
                </div>
                <div>
                    <label for="image" class="custom-file-upload">
                        Choose File
                    </label>
                    <span id='val'>No file chosen</span>
                    <input name="image" id="image" type="file" />
                    @error('image')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="year_of_establishment" class="form-label">Year of Establishment</label>
                </div>
                <div>
                    <input type="text" name="year_of_establishment" id="year_of_establishment"
                        value="{{ old('year_of_establishment') }}">
                    @error('year_of_establishment')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="gst_number" class="form-label">GST Number</label>
                </div>
                <div>
                    <input type="text" name="gst_number" id="gst_number" value="{{ old('gst_number') }}">
                    @error('gst_number')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="address" class="form-label">Address</label>
                </div>
                <div>
                    <input type="text" name="address" id="address" value="{{ old('address') }}">
                    @error('address')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="city" class="form-label">City</label>
                </div>
                <div>
                    <input type="text" name="city" id="city" value="{{ old('city') }}">
                    @error('city')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="state" class="form-label">State</label>
                </div>
                <div>
                    <input type="text" name="state" id="state" value="{{ old('state') }}">
                    @error('state')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="pincode" class="form-label">Pincode</label>
                </div>
                <div>
                    <input type="text" name="pincode" id="pincode" value="{{ old('pincode') }}">
                    @error('pincode')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="business_email" class="form-label">Business Email</label>
                </div>
                <div>
                    <input type="text" name="business_email" id="business_email"
                        value="{{ old('business_email') }}">
                    @error('business_email')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="type_of_business" class="form-label">Type of Business</label>
                </div>
                <div>
                    <input type="text" name="type_of_business" id="type_of_business"
                        value="{{ old('type_of_business') }}">
                    @error('type_of_business')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="name_of_partner_1" class="form-label">Name of Partner 1</label>
                </div>
                <div>
                    <input type="text" name="name_of_partner_1" id="name_of_partner_1"
                        value="{{ old('name_of_partner_1') }}">
                    @error('name_of_partner_1')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="name_of_partner_2" class="form-label">Name of Partner 2</label>
                </div>
                <div>
                    <input type="text" name="name_of_partner_2" id="name_of_partner_2"
                        value="{{ old('name_of_partner_2') }}">
                    @error('name_of_partner_2')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="phoneno_2" class="form-label">Mobile No 2</label>
                </div>
                <div>
                    <input type="text" name="phoneno_2" id="phoneno_2" value="{{ old('phoneno_2') }}">
                    @error('phoneno_2')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="vendor_live_photo" class="form-label">Vendor Live Photo</label>
                </div>
                <div>
                    <label for="vendor_live_photo" class="custom-file-upload">
                        Choose File
                    </label>
                    <span id='vendor_live_photo_name'>No file chosen</span>
                    <input name="vendor_live_photo" id="vendor_live_photo" type="file" />
                    @error('vendor_live_photo')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="business_live_photo" class="form-label">Business Live Photo</label>
                </div>
                <div>
                    <label for="business_live_photo" class="custom-file-upload">
                        Choose File
                    </label>
                    <span id='business_live_photo_name'>No file chosen</span>
                    <input name="business_live_photo" id="business_live_photo" type="file" />
                    @error('business_live_photo')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="gst_certificate" class="form-label">GST Certificate</label>
                </div>
                <div>
                    <label for="gst_certificate" class="custom-file-upload">
                        Choose File
                    </label>
                    <span id='gst_certificate_name'>No file chosen</span>
                    <input name="gst_certificate" id="gst_certificate" type="file" />
                    @error('gst_certificate')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="partnersheep_deed" class="form-label">Partnersheep Deed</label>
                </div>
                <div>
                    <label for="partnersheep_deed" class="custom-file-upload">
                        Choose File
                    </label>
                    <span id='partnersheep_deed_name'>No file chosen</span>
                    <input name="partnersheep_deed" id="partnersheep_deed" type="file" />
                    @error('partnersheep_deed')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="adharcard_one" class="form-label">Adharcard 1</label>
                </div>
                <div>
                    <label for="adharcard_one" class="custom-file-upload">
                        Choose File
                    </label>
                    <span id='adharcard_one_name'>No file chosen</span>
                    <input name="adharcard_one" id="adharcard_one" type="file" />
                    @error('adharcard_one')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="adharcard_two" class="form-label">Adharcard 2</label>
                </div>
                <div>
                    <label for="adharcard_two" class="custom-file-upload">
                        Choose File
                    </label>
                    <span id='adharcard_two_name'>No file chosen</span>
                    <input name="adharcard_two" id="adharcard_two" type="file" />
                    @error('adharcard_two')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-input-group">
                <div>
                    <label for="cancel_cheque" class="form-label">Cancel Cheque</label>
                </div>
                <div>
                    <label for="cancel_cheque" class="custom-file-upload">
                        Choose File
                    </label>
                    <span id='cancel_cheque_name'>No file chosen</span>
                    <input name="cancel_cheque" id="cancel_cheque" type="file" />
                    @error('cancel_cheque')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="button">Create</button>
            <button type="button" class="button" id="cancel"
                onclick="window.location='{{ route('manage-users', ['type' => $type]) }}'">Cancel</button>
        </form>
    </div>
    <script>
        $("input[type='file']").change(function() {
            $(this).prev('span').text(this.value.replace(/C:\\fakepath\\/i, ''))
        })
    </script>
@endsection
