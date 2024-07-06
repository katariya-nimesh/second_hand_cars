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
        'car_fuel_varient_id'
    ];

    public function car_images()
    {
        return $this->hasMany(CarImage::class, 'car_varient_type_id');
    }

    public function car_fuel_varient()
    {
        return $this->belongsTo(CarFuelVariant::class);
    }
}
