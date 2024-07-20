<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWalletTransaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'car_details_id',
        'car_image',
        'car_name',
        'date',
        'amount',
        'transaction_type',
    ];
}
