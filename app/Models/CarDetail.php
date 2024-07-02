<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_varient_type_id',
        'car_owner_id',
        'car_kilometer_id',
        'price',
        'status'
    ];
}
