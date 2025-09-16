<?php

namespace App\Http\Controllers;
use App\Models\Flight;

use Illuminate\Http\Request;

class FlightController extends Controller
{
   // Show list of flights
    public function index()
    {
        $flights = Flight::all(); // Fetch all flights
        return view('flights.index', compact('flights'));
    }

    // Show form to create a new flight
    public function create()
    {
        return view('flights.create');
    }

    // Store new flight
    public function store(Request $request)
    {
        $request->validate([
            'flight_number' => 'required|unique:flights',
            'departure' => 'required',
            'destination' => 'required',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
        ]);

        Flight::create($request->all());

        return redirect()->route('flights.index')->with('success', 'Flight added successfully!');
    }
    public function edit(Flight $flight)
{
    return view('flights.edit', compact('flight'));
}
    // Update flight
    public function update(Request $request, Flight $flight)
    {
        $request->validate([
            'flight_number' => 'required|unique:flights,flight_number,' . $flight->id,
            'departure' => 'required',
            'destination' => 'required',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
        ]);

        $flight->update($request->all());

        return redirect()->route('flights.index')->with('success', 'Flight updated successfully!');
    }

    // Delete flight
    public function destroy(Flight $flight)
    {
        $flight->delete();
        return redirect()->route('flights.index')->with('success', 'Flight deleted successfully!');
    }
}
