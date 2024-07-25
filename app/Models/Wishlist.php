<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CarFuelVariant;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_details_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car_detail()
    {
        return $this->belongsTo(CarDetail::class);
    }
}
