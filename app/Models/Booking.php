<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'vehicle_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_nic',
        'pickup_date',
        'dropoff_date',
        'pickup_location',
        'status',
        'notes',
    ];

    protected $casts = [
        'pickup_date'  => 'date',
        'dropoff_date' => 'date',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
