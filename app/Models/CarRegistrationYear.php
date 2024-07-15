<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarBrand;


class CarRegistrationYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'car_brand_id'
    ];

    public function carBrand()
    {
        return $this->belongsTo(CarBrand::class);
    }
}
