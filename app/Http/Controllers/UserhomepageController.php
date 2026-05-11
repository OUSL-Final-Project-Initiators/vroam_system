<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Booking;

class UserhomepageController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = collect();
        $searched = false;

        if ($request->filled('pickup_date') && $request->filled('dropoff_date')) {
            $searched = true;

            $query = Vehicle::where('status', 'available');

            if ($request->filled('vehicle_type') && $request->vehicle_type !== 'Select Category') {
                $query->where('vehicle_category', 'like', '%' . $request->vehicle_type . '%');
            }

            if ($request->filled('location')) {
                $query->where('location', 'like', '%' . $request->location . '%');
            }

            $vehicles = $query->get();
        }

        // Top 4 most-booked vehicles
        $topVehicles = Vehicle::withCount('bookings')
                              ->orderBy('bookings_count', 'desc')
                              ->take(4)
                              ->get();

        return view('userhomepage.index', compact('vehicles', 'searched', 'topVehicles'));
    }

    public function category(string $category)
    {
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

        $vehicles = Vehicle::where('vehicle_category', $dbCategory)
                           ->orderBy('created_at', 'desc')
                           ->get();

        return view('userhomepage.category', compact('vehicles', 'dbCategory'));
    }

    public function show(int $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('userhomepage.show', compact('vehicle'));
    }

    public function bookingForm(int $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        if ($vehicle->status !== 'available') {
            return redirect()->route('user.show', $id)
                             ->with('error', 'This vehicle is not available for booking.');
        }

        return view('userhomepage.booking', compact('vehicle'));
    }

    public function bookingStore(Request $request, int $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'customer_name'    => 'required|string|max:100',
            'customer_email'   => 'required|email|max:150',
            'customer_phone'   => 'required|string|max:20',
            'customer_nic'     => 'required|string|max:20',
            'pickup_date'      => 'required|date|after_or_equal:today',
            'dropoff_date'     => 'required|date|after:pickup_date',
            'pickup_location'  => 'required|string|max:150',
            'notes'            => 'nullable|string|max:500',
        ]);

        Booking::create([
            'vehicle_id'      => $vehicle->id,
            'customer_name'   => $request->customer_name,
            'customer_email'  => $request->customer_email,
            'customer_phone'  => $request->customer_phone,
            'customer_nic'    => $request->customer_nic,
            'pickup_date'     => $request->pickup_date,
            'dropoff_date'    => $request->dropoff_date,
            'pickup_location' => $request->pickup_location,
            'status'          => 'pending',
            'notes'           => $request->notes,
        ]);

        // Mark vehicle as rented
        $vehicle->update(['status' => 'rented']);

        return redirect()->route('user.show', $id)
                         ->with('success', 'Booking confirmed! We will contact you shortly.');
    }
}
