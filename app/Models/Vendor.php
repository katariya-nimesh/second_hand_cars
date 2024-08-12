<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = "users";

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('vendor', function ($builder) {
            $builder->where('user_type', 'vendor');
        });
    }

}
