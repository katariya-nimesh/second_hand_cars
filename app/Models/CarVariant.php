<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarVariant extends Model
{
    use HasFactory;

    protected $table = "car_varient";

    protected $fillable = [
        'name',
        'car_registration_year_id'
    ];

    public function carRegistrationYear()
    {
        return $this->belongsTo(CarRegistrationYear::class);
    }

    public function carFuelTypes()
    {
        return $this->hasMany(CarFuelType::class);
    }
}
