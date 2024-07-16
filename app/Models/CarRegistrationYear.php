<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarBrand;
use App\Models\CarVariant;


class CarRegistrationYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'car_brand_id'
    ];

    public function car_brand()
    {
        return $this->belongsTo(CarBrand::class);
    }

    public function car_varients()
    {
        return $this->hasMany(CarVariant::class, 'car_registration_year_id');
    }
}
