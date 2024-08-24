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
        'type',
        'car_details_id'
    ];

    public function getImageAttribute($value)
    {
        return $value ? asset($value) : null;
    }
}
