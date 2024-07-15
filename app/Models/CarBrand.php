<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarRegistrationYear;

class CarBrand extends Model
{
    use HasFactory;

    protected $table = "car_brand";

    protected $fillable = [
        'name',
        'image'
    ];

    public function car_registration_years()
    {
        return $this->hasMany(CarRegistrationYear::class, 'car_brand_id');
    }
}
