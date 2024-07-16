<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarVariantType;
use App\Models\CarFuelType;

class CarFuelVariant extends Model
{
    use HasFactory;

    protected $table = "car_fuel_varient";

    protected $fillable = [
        'name',
        'car_fuel_type_id'
    ];

    public function car_varient_types()
    {
        return $this->hasMany(CarVariantType::class, 'car_fuel_varient_id');
    }

    public function car_fuel_type()
    {
        return $this->belongsTo(CarFuelType::class);
    }
}
