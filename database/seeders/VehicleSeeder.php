<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            ['vehicle_category' => 'Car',                    'location' => 'Colombo',     'brand' => 'Toyota',   'model' => 'Aqua',       'status' => 'available'],
            ['vehicle_category' => 'Car',                    'location' => 'Kandy',       'brand' => 'Honda',    'model' => 'Vezel',      'status' => 'rented'],
            ['vehicle_category' => 'SUV',                    'location' => 'Galle',       'brand' => 'Nissan',   'model' => 'X-Trail',    'status' => 'available'],
            ['vehicle_category' => 'SUV',                    'location' => 'Negombo',     'brand' => 'Mitsubishi','model' => 'Outlander', 'status' => 'maintenance'],
            ['vehicle_category' => 'Van',                    'location' => 'Matara',      'brand' => 'Toyota',   'model' => 'HiAce',      'status' => 'available'],
            ['vehicle_category' => 'Motorcycle',             'location' => 'Colombo',     'brand' => 'Honda',    'model' => 'CB150R',     'status' => 'available'],
            ['vehicle_category' => 'Motorcycle',             'location' => 'Kurunegala',  'brand' => 'Yamaha',   'model' => 'FZ-S',       'status' => 'rented'],
            ['vehicle_category' => 'Bicycle',                'location' => 'Colombo',     'brand' => 'Trek',     'model' => 'Marlin 5',   'status' => 'available'],
            ['vehicle_category' => 'Construction Vehicle',   'location' => 'Gampaha',     'brand' => 'Caterpillar','model' => '320 GC',  'status' => 'available'],
            ['vehicle_category' => 'Agricultural Vehicle',   'location' => 'Anuradhapura','brand' => 'Kubota',   'model' => 'M7-172',     'status' => 'maintenance'],
        ];

        Vehicle::insert($vehicles);
    }
}
