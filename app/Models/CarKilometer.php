<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarKilometer extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_km',
        'end_km'
    ];
}
