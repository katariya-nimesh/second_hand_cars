<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarFuelType;
use App\Models\CarRegistrationYear;

class CarVariant extends Model
{
    use HasFactory;

    protected $table = "car_varient";

    protected $fillable = [
        'name',
        'car_registration_year_id'
    ];

    public function car_fuel_types()
    {
        return $this->hasMany(CarFuelType::class, 'car_varient_id');
    }

    public function car_registration_year()
    {
        return $this->belongsTo(CarRegistrationYear::class);
    }
}
