<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'vehicle_category',
        'location',
        'brand',
        'model',
        'status',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
