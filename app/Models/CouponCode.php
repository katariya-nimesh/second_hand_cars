<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount'
    ];

    protected $appends = [
        'coupon_code'
    ];

    public function getCouponCodeAttribute()
    {
        return $this->code;
    }
}
