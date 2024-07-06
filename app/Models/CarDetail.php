<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarVariantType;
use App\Models\CarOwner;
use App\Models\CarKilometer;


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
        'accident'
    ];

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
}
