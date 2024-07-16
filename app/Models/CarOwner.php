<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarOwner extends Model
{
    use HasFactory;

    protected $table = "car_owner";

    protected $fillable = [
        'name'
    ];
}
