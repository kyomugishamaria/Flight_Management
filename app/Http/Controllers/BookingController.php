<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Flight;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Show all available flights
    public function index()
    {
        $flights = Flight::all();
        return view('passengers.flights', compact('flights'));
    }

    // Store a booking
    public function store(Flight $flight)
    {
        Booking::create([
            'passenger_id' => Auth::guard('passenger')->id(),
            'flight_id'    => $flight->id,
            'status'       => 'pending',
        ]);

        return redirect()->route('passengers.bookings')->with('success', 'Flight booked successfully!');
    }

    // Show my bookings
    public function myBookings()
    {
        $bookings = Booking::with('flight')
            ->where('passenger_id', Auth::guard('passenger')->id())
            ->get();

        return view('passengers.bookings', compact('bookings'));
    }
}
