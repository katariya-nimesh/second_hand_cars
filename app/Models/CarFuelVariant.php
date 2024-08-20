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
    ];

}
