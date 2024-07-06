<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarFuelVariant;
use App\Models\CarVariant;

class CarFuelType extends Model
{
    use HasFactory;

    protected $table = "car_fuel_type";

    protected $fillable = [
        'fuel_type',
        'transmission',
        'car_varient_id'
    ];

    public function car_fuel_varients()
    {
        return $this->hasMany(CarFuelVariant::class, 'car_fuel_type_id');
    }

    public function car_varient()
    {
        return $this->belongsTo(CarVariant::class);
    }
}
