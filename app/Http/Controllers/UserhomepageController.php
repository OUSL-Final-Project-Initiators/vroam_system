<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class UserhomepageController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = collect();
        $searched = false;

        if ($request->filled('pickup_date') && $request->filled('dropoff_date')) {
            $searched = true;

            $query = Vehicle::where('status', 'available');

            // Vehicle type filter
            if ($request->filled('vehicle_type') && $request->vehicle_type !== 'Select Category') {
                $query->where('vehicle_category', 'like', '%' . $request->vehicle_type . '%');
            }

            // Location filter — smart two-level handling
            // When the user picks "All of Galle" from the dropdown, the hidden input
            // sends "Galle" (stripped). When they pick a specific town like "Hikkaduwa",
            // it sends "Hikkaduwa". An empty value (All of Sri Lanka) skips filtering.
            if ($request->filled('location')) {
                $query->where('location', 'like', '%' . $request->location . '%');
            }

            $vehicles = $query->get();
        }

        return view('userhomepage.index', compact('vehicles', 'searched'));
    }

    public function category(string $category)
    {
        // Map URL-friendly slug back to the DB value
        $categoryMap = [
            'bicycles'               => 'Bicycle',
            'motorcycles'            => 'Motorcycle',
            'cars'                   => 'Car',
            'suvs'                   => 'SUV',
            'vans'                   => 'Van',
            'trucks'                 => 'Truck',
            'agricultural-vehicles'  => 'Agricultural Vehicle',
            'construction-vehicles'  => 'Construction Vehicle',
            'camper-vehicles'        => 'Camper Vehicle',
            'special-vehicles'       => 'Special Vehicle',
        ];

        $dbCategory = $categoryMap[strtolower($category)] ?? $category;

        // Newest listings first (latest created_at at the top)
        $vehicles = Vehicle::where('vehicle_category', $dbCategory)
                           ->orderBy('created_at', 'desc')
                           ->get();

        return view('userhomepage.category', compact('vehicles', 'dbCategory'));
    }
}
