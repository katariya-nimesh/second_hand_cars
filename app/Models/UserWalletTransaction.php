<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_details_id',
        'car_image',
        'car_name',
        'date',
        'amount',
        'transaction_type',
    ];

    public function car_detail()
    {
        return $this->belongsTo(CarDetail::class, 'car_details_id')->with(['car_varient_type',
                'car_varient_type.car_fuel_varient.car_fuel_type.car_varient.car_registration_year.car_brand',
                'car_owner',
                'car_kilometer',
                'car_image',
                'user'])->where('status', 'Active')->where('publish_status', 'Publish');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCarImageAttribute($value)
    {
        return $value ? asset($value) : null;
    }
}
