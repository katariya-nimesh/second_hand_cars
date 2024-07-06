<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarKilometer extends Model
{
    use HasFactory;

    protected $table = "car_kilometer";

    protected $fillable = [
        'start_km',
        'end_km'
    ];

    public function getFullTextAttribute()
    {
        return "{$this->start_km} Km - {$this->end_km} Km";
    }

    protected $appends = ['full_text'];
}
