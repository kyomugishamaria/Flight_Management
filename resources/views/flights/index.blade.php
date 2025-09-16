@extends('layouts.app')

@section('content')
    <h1 class="h4 fw-bold mb-4">✈️ Flights</h1>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle shadow-sm rounded">
            <thead class="table-header">
                <tr>
                    <th scope="col">Flight No.</th>
                    <th scope="col">Departure</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Departure Time</th>
                    <th scope="col">Arrival Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flights as $flight)
                    <tr>
                        <td>{{ $flight->flight_number }}</td>
                        <td>{{ $flight->departure }}</td>
                        <td>{{ $flight->destination }}</td>
                        <td>{{ \Carbon\Carbon::parse($flight->departure_time)->format('d M Y, H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($flight->arrival_time)->format('d M Y, H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
