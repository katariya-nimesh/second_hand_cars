<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarBrand;

class CarVariant extends Model
{
    use HasFactory;

    protected $table = "car_varient";

    protected $fillable = [
        'name',
        'car_brand_id'
    ];

    public function car_brand()
    {
        return $this->belongsTo(CarBrand::class);
    }

}
