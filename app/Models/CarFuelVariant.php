<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarFuelVariant extends Model
{
    use HasFactory;

    protected $table = "car_fuel_varient";

    protected $fillable = [
        'name',
        'car_fuel_type_id'
    ];
}
