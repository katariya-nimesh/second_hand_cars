<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarKilometer extends Model
{
    use HasFactory;

    protected $table = 'car_kilometer';
    
    protected $fillable = [
        'start_km',
        'end_km'
    ];

    // public static function boot()
    // {
    //     parent::boot();

    //     // Validate no overlapping or duplicate ranges on create or update
    //     static::saving(function ($model) {
    //         $existing = static::where(function ($query) use ($model) {
    //             $query->whereBetween('start_km', [$model->start_km, $model->end_km])
    //                   ->orWhereBetween('end_km', [$model->start_km, $model->end_km]);
    //         })->exists();

    //         if ($existing) {
    //             return false; // Prevent saving if overlapping or duplicate range found
    //         }
    //     });
    // }
}
