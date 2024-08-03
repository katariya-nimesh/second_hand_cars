<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQR extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'qr_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getQrImageAttribute($value)
    {
        return $value ? asset($value) : null;
    }
}
