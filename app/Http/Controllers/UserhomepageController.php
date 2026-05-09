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

            // Filter by vehicle category if selected
            if ($request->filled('vehicle_type') && $request->vehicle_type !== 'Select Category') {
                $query->where('vehicle_category', 'like', '%' . $request->vehicle_type . '%');
            }

            // Filter by location if entered
            if ($request->filled('location')) {
                $query->where('location', 'like', '%' . $request->location . '%');
            }

            $vehicles = $query->get();
        }

        return view('userhomepage.index', compact('vehicles', 'searched'));
    }
}
