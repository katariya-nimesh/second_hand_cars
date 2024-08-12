<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CarDetail;
use App\Models\CarFuelVariant;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_details_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car_detail()
    {
        return $this->belongsTo(CarDetail::class, 'car_details_id')->with(['car_varient_type',
                'car_varient_type.car_fuel_varient.car_fuel_type.car_varient.car_registration_year.car_brand',
                'car_owner',
                'car_kilometer',
                'car_image',
                'user'])->where('status', 'Active')->where('publish_status', 'Publish');
    }
}
