<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarImage;
use App\Models\CarFuelVariant;


class CarVariantType extends Model
{
    use HasFactory;

    protected $table = "car_varient_type";

    protected $fillable = [
        'name',
    ];


}
