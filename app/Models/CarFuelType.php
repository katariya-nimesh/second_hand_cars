<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarFuelType extends Model
{
    use HasFactory;

    protected $table = "car_fuel_type";

    protected $fillable = [
        'fuel_type',
        'transmission',
        'car_varient_id'
    ];

    public function carVariant()
    {
        return $this->belongsTo(CarVariant::class, 'car_varient_id');
    }

    public function carFuelVarients()
    {
        return $this->hasMany(CarFuelVariant::class);
    }
}
