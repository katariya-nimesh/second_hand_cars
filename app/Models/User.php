<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phoneno',
        'business_name',
        'location',
        'user_type',
        'uid',
        'fcm_token',
        'image',
        'status',
        'vendor_status',
        'year_of_establishment',
        'gst_number',
        'address',
        'city',
        'state',
        'pincode',
        'business_email',
        'type_of_business',
        'name_of_partner_1',
        'name_of_partner_2',
        'phoneno_2',
        'vendor_live_photo',
        'business_live_photo',
        'gst_certificate',
        'partnersheep_deed',
        'adharcard_one',
        'adharcard_two',
        'cancel_cheque',
        'plan_id',
        'plan_start_date',
        'plan_end_date'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImageAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function getVendorLivePhotoAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function getBusinessLivePhotoAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function getGstCertificateAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function getPartnersheepDeedAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function getAdharcardOneAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function getAdharcardTwoAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function getCancelChequeAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function car_detail()
    {
        return $this->hasMany(CarDetail::class, 'user_id')->with([
                'car_varient_type',
                'car_brand',
                'car_registration_year',
                'car_varient',
                'car_fuel_type',
                'car_fuel_varient',
                'car_owner',
                'car_kilometer',
                'car_image',
                'user'
            ])->where('status', 'Active')->where('publish_status', 'Publish');
    }

    public function user_qr()
    {
        return $this->belongsTo(UserQR::class);
    }

    public function getQrImagePathAttribute()
    {
        $qrImage = UserQR::where('user_id', $this->id)->first();
        if($qrImage){
            return $qrImage->qr_image ? asset($qrImage->qr_image) : null;
        }
        return null;
    }

    protected $appends = ['qr_image_path', 'profile_updated', 'plan_details'];

    public function getProfileUpdatedAttribute()
    {
        // Define the fields that need to be checked
        $requiredFields = [
            'email',
            'phoneno',
            'business_name',
            'location',
            'user_type',
            'uid',
            'fcm_token',
            'image',
            'year_of_establishment',
            'gst_number',
            'address',
            'city',
            'state',
            'pincode',
            'business_email',
            'type_of_business',
            'vendor_live_photo',
            'business_live_photo',
            'gst_certificate',
            'adharcard_one',
            'adharcard_two',
            'cancel_cheque'
        ];

        $partnershipFields = [
            'name_of_partner_1',
            'phoneno_2',
            'partnersheep_deed'
        ];

        // Retrieve the user
        $user = User::find($this->id);

        // Check if the user exists
        if (!$user) {
            return false;
        }

        // Check for missing fields using filled method
        foreach ($requiredFields as $field) {
            if (is_null($user->$field) || empty($user->$field)) {
                return false;
            }
        }

        if($this->type_of_business == "Partnership"){
            foreach ($partnershipFields as $field) {
                if (is_null($user->$field) || empty($user->$field)) {
                    return false;
                }
            }
        }

        return true;
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function getPlanActiveAttribute()
    {
        if($this->plan_id){
            $planDetails = Plan::find($this->plan_id);
            $activeCars = CarDetail::where([
                'user_id' => $this->id,
                'status' => 'Active',
                'publish_status' => 'Publish'
            ])->count();

            if($planDetails->total_cars > $activeCars){
                return true;
            }
        }
        return false;
    }

    public function getPlanDetailsAttribute()
    {
        if($this->plan_id){
            $planDetails = Plan::find($this->plan_id);
            $activeCars = CarDetail::where([
                'user_id' => $this->id,
                'status' => 'Active',
                'publish_status' => 'Publish'
            ])->count();

            $isExpried = $this->plan_end_date && Carbon::parse($this->plan_end_date)->isPast();

            return [
                'active_car' => $activeCars,
                'total_car' => $planDetails->total_cars,
                'remaining_car' => $planDetails->total_cars - $activeCars,
                'is_expried' => $isExpried
            ];
        }
        return null;
    }
}
