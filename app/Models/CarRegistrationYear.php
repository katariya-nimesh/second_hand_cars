<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarRegistrationYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'car_brand_id'
    ];
}
