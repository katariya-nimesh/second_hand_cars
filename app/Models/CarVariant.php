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
    ];

}
