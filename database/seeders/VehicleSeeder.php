<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            // ── Cars ──────────────────────────────────────────────────────────
            ['vehicle_category' => 'Car', 'location' => 'Colombo',      'brand' => 'Toyota',    'model' => 'Aqua',          'status' => 'available'],
            ['vehicle_category' => 'Car', 'location' => 'Galle',        'brand' => 'Honda',     'model' => 'Prius',         'status' => 'available'],
            ['vehicle_category' => 'Car', 'location' => 'Kandy',        'brand' => 'Honda',     'model' => 'Vezel',         'status' => 'rented'],
            ['vehicle_category' => 'Car', 'location' => 'Negombo',      'brand' => 'Toyota',    'model' => 'Corolla',       'status' => 'available'],
            ['vehicle_category' => 'Car', 'location' => 'Matara',       'brand' => 'Suzuki',    'model' => 'Alto',          'status' => 'available'],
            ['vehicle_category' => 'Car', 'location' => 'Colombo',      'brand' => 'Nissan',    'model' => 'Leaf',          'status' => 'available'],
            ['vehicle_category' => 'Car', 'location' => 'Kandy',        'brand' => 'Toyota',    'model' => 'Vitz',          'status' => 'maintenance'],
            ['vehicle_category' => 'Car', 'location' => 'Gampaha',      'brand' => 'Mazda',     'model' => 'Axela',         'status' => 'available'],
            ['vehicle_category' => 'Car', 'location' => 'Jaffna',       'brand' => 'Hyundai',   'model' => 'i10',           'status' => 'available'],
            ['vehicle_category' => 'Car', 'location' => 'Kurunegala',   'brand' => 'Kia',       'model' => 'Picanto',       'status' => 'rented'],

            // ── SUVs ──────────────────────────────────────────────────────────
            ['vehicle_category' => 'SUV', 'location' => 'Galle',        'brand' => 'Nissan',    'model' => 'X-Trail',       'status' => 'available'],
            ['vehicle_category' => 'SUV', 'location' => 'Negombo',      'brand' => 'Mitsubishi','model' => 'Outlander',     'status' => 'maintenance'],
            ['vehicle_category' => 'SUV', 'location' => 'Colombo',      'brand' => 'Toyota',    'model' => 'Land Cruiser',  'status' => 'available'],
            ['vehicle_category' => 'SUV', 'location' => 'Kandy',        'brand' => 'Honda',     'model' => 'CR-V',          'status' => 'available'],
            ['vehicle_category' => 'SUV', 'location' => 'Matara',       'brand' => 'Ford',      'model' => 'EcoSport',      'status' => 'rented'],
            ['vehicle_category' => 'SUV', 'location' => 'Gampaha',      'brand' => 'Jeep',      'model' => 'Compass',       'status' => 'available'],
            ['vehicle_category' => 'SUV', 'location' => 'Anuradhapura', 'brand' => 'Suzuki',    'model' => 'Vitara',        'status' => 'available'],

            // ── Vans ──────────────────────────────────────────────────────────
            ['vehicle_category' => 'Van', 'location' => 'Matara',       'brand' => 'Toyota',    'model' => 'HiAce',         'status' => 'available'],
            ['vehicle_category' => 'Van', 'location' => 'Colombo',      'brand' => 'Toyota',    'model' => 'KDH 200',       'status' => 'available'],
            ['vehicle_category' => 'Van', 'location' => 'Kandy',        'brand' => 'Nissan',    'model' => 'Caravan',       'status' => 'rented'],
            ['vehicle_category' => 'Van', 'location' => 'Galle',        'brand' => 'Mercedes',  'model' => 'Sprinter',      'status' => 'available'],
            ['vehicle_category' => 'Van', 'location' => 'Negombo',      'brand' => 'Mitsubishi','model' => 'L300',          'status' => 'maintenance'],

            // ── Motorcycles ───────────────────────────────────────────────────
            ['vehicle_category' => 'Motorcycle', 'location' => 'Colombo',     'brand' => 'Honda',  'model' => 'CB150R',    'status' => 'available'],
            ['vehicle_category' => 'Motorcycle', 'location' => 'Kurunegala',  'brand' => 'Yamaha', 'model' => 'FZ-S',      'status' => 'rented'],
            ['vehicle_category' => 'Motorcycle', 'location' => 'Galle',       'brand' => 'TVS',    'model' => 'Apache 160','status' => 'available'],
            ['vehicle_category' => 'Motorcycle', 'location' => 'Kandy',       'brand' => 'Bajaj',  'model' => 'Pulsar 150','status' => 'available'],
            ['vehicle_category' => 'Motorcycle', 'location' => 'Negombo',     'brand' => 'Yamaha', 'model' => 'MT-15',     'status' => 'available'],
            ['vehicle_category' => 'Motorcycle', 'location' => 'Matara',      'brand' => 'Honda',  'model' => 'XR150L',    'status' => 'maintenance'],
            ['vehicle_category' => 'Motorcycle', 'location' => 'Jaffna',      'brand' => 'TVS',    'model' => 'Star City', 'status' => 'available'],

            // ── Bicycles ──────────────────────────────────────────────────────
            ['vehicle_category' => 'Bicycle', 'location' => 'Colombo',    'brand' => 'Trek',     'model' => 'Marlin 5',    'status' => 'available'],
            ['vehicle_category' => 'Bicycle', 'location' => 'Kandy',      'brand' => 'Giant',    'model' => 'Talon 3',     'status' => 'available'],
            ['vehicle_category' => 'Bicycle', 'location' => 'Galle',      'brand' => 'Merida',   'model' => 'Big Nine 20', 'status' => 'available'],
            ['vehicle_category' => 'Bicycle', 'location' => 'Negombo',    'brand' => 'Trek',     'model' => 'FX 3',        'status' => 'rented'],
            ['vehicle_category' => 'Bicycle', 'location' => 'Matara',     'brand' => 'Giant',    'model' => 'Escape 3',    'status' => 'available'],

            // ── Construction Vehicles ─────────────────────────────────────────
            ['vehicle_category' => 'Construction Vehicle', 'location' => 'Gampaha',      'brand' => 'Caterpillar', 'model' => '320 GC',      'status' => 'available'],
            ['vehicle_category' => 'Construction Vehicle', 'location' => 'Colombo',      'brand' => 'Komatsu',     'model' => 'PC200-8',     'status' => 'rented'],
            ['vehicle_category' => 'Construction Vehicle', 'location' => 'Kurunegala',   'brand' => 'JCB',         'model' => '3DX',         'status' => 'available'],
            ['vehicle_category' => 'Construction Vehicle', 'location' => 'Kandy',        'brand' => 'Volvo',       'model' => 'EC220E',      'status' => 'maintenance'],
            ['vehicle_category' => 'Construction Vehicle', 'location' => 'Anuradhapura', 'brand' => 'Caterpillar', 'model' => '140 Grader',  'status' => 'available'],

            // ── Agricultural Vehicles ─────────────────────────────────────────
            ['vehicle_category' => 'Agricultural Vehicle', 'location' => 'Anuradhapura', 'brand' => 'Kubota',      'model' => 'M7-172',      'status' => 'maintenance'],
            ['vehicle_category' => 'Agricultural Vehicle', 'location' => 'Polonnaruwa',  'brand' => 'Mahindra',    'model' => '575 DI',      'status' => 'available'],
            ['vehicle_category' => 'Agricultural Vehicle', 'location' => 'Kurunegala',   'brand' => 'John Deere',  'model' => '5050 D',      'status' => 'available'],
            ['vehicle_category' => 'Agricultural Vehicle', 'location' => 'Matara',       'brand' => 'Kubota',      'model' => 'L3408',       'status' => 'rented'],
            ['vehicle_category' => 'Agricultural Vehicle', 'location' => 'Gampaha',      'brand' => 'TAFE',        'model' => '45 DI',       'status' => 'available'],

            // ── Trucks ────────────────────────────────────────────────────────
            ['vehicle_category' => 'Truck', 'location' => 'Colombo',     'brand' => 'Isuzu',    'model' => 'ELF 150',       'status' => 'available'],
            ['vehicle_category' => 'Truck', 'location' => 'Gampaha',     'brand' => 'Tata',     'model' => 'LPT 1613',      'status' => 'available'],
            ['vehicle_category' => 'Truck', 'location' => 'Kandy',       'brand' => 'Ashok Leyland', 'model' => 'Dost',     'status' => 'rented'],
            ['vehicle_category' => 'Truck', 'location' => 'Galle',       'brand' => 'Isuzu',    'model' => 'Forward',       'status' => 'available'],
            ['vehicle_category' => 'Truck', 'location' => 'Matara',      'brand' => 'Mitsubishi','model' => 'Canter',        'status' => 'maintenance'],
        ];

        Vehicle::insert($vehicles);
    }
}
