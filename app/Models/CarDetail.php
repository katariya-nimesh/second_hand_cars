<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarVariantType;
use App\Models\CarOwner;
use App\Models\CarKilometer;
use App\Models\CarImage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\CarBrand;
use App\Models\CarRegistrationYear;
use App\Models\CarVariant;
use App\Models\CarFuelType;
use App\Models\CarFuelVariant;



class CarDetail extends Model
{
    use HasFactory;

    protected $table = "car_details";

    protected $fillable = [
        'user_id',
        'car_varient_type_id',
        'car_owner_id',
        'car_kilometer_id',
        'price',
        'status',
        'accident',
        'publish_status',
        'car_brand_id',
        'car_registration_year_id',
        'car_varient_id',
        'transmission',
        'car_fuel_type_id',
        'car_fuel_varient_id',
    ];

    public function getWishlistStatusAttribute()
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('user_id', $user->id)->where('car_details_id', $this->id)->first();

        if ($wishlist) {
            return true;
        }
        return false;
    }

    public function getWishlistDetailsAttribute()
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('user_id', $user->id)->where('car_details_id', $this->id)->first();

        return $wishlist;
    }

    protected $appends = ['wishlist_status', 'wishlist_details'];

    public function car_brand()
    {
        return $this->belongsTo(CarBrand::class);
    }

    public function car_registration_year()
    {
        return $this->belongsTo(CarRegistrationYear::class);
    }

    public function car_varient()
    {
        return $this->belongsTo(CarVariant::class);
    }

    public function car_fuel_type()
    {
        return $this->belongsTo(CarFuelType::class);
    }

    public function car_fuel_varient()
    {
        return $this->belongsTo(CarFuelVariant::class);
    }

    public function car_varient_type()
    {
        return $this->belongsTo(CarVariantType::class);
    }

    public function car_owner()
    {
        return $this->belongsTo(CarOwner::class);
    }

    public function car_kilometer()
    {
        return $this->belongsTo(CarKilometer::class);
    }

    public function car_image()
    {
        return $this->hasMany(CarImage::class, 'car_details_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
