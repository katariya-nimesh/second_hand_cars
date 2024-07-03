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
}
