<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'vendor_status'
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

    public function car_detail()
    {
        return $this->hasMany(CarDetail::class, 'user_id')->with(['car_varient_type',
                'car_varient_type.car_fuel_varient.car_fuel_type.car_varient.car_registration_year.car_brand',
                'car_owner',
                'car_kilometer',
                'car_image',
                'user'])->where('status', 'Active')->where('publish_status', 'Publish');
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

    protected $appends = ['qr_image_path', 'profile_updated'];

    public function getProfileUpdatedAttribute()
    {
        // Define the fields that need to be checked
        $requiredFields = [
            'name',
            'email',
            'phoneno',
            'business_name',
            'location',
            'user_type',
            'uid',
            'fcm_token',
            'image'
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

        return true;
    }
}
