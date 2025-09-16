<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passenger;

class AdminDashboardController extends Controller
{
    
    public function index()
    {
        $flights = Flight::orderBy('departure_time')->get();
        $passengersCount = Passenger::count();
        $ticketsCount = Ticket::count();
        $flightsCount = $flights->count();

        return view('admin.dashboard', compact('flights', 'passengersCount', 'ticketsCount', 'flightsCount'));
    }

    // Search functionality
    public function search(Request $request)
    {
        $query = $request->input('query');

        $passengers = Passenger::where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();

        return view('dashboards.search_results', compact('passengers', 'query'));
    }

}
