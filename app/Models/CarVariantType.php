<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarVariantType extends Model
{
    use HasFactory;
    protected $table = "car_varient_type";
    protected $fillable = [
        'name',
        'car_fuel_varient_id'
    ];

    public function carFuelVariant()
    {
        return $this->belongsTo(CarFuelVariant::class, 'car_fuel_varient_id');
    }
}
