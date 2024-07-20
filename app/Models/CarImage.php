<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarVariantType;

class CarImage extends Model
{
    use HasFactory;

    protected $table = "car_images";

    protected $fillable = [
        'image',
        'car_varient_type_id',
        'type'
    ];

    public function car_varient_type()
    {
        return $this->belongsTo(CarVariantType::class);
    }

    public function getImageAttribute($value)
    {
        return $value ? asset($value) : null;
    }
}
