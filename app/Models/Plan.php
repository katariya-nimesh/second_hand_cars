<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = "plans";

    protected $fillable = [
        'name',
        'total_cars',
        'price',
        'status',
        'description'
    ];
}
