@extends('layouts.app')

@section('content')
    <h1 class="mb-4">📑 My Bookings</h1>

    <table class="table table-striped table-hover">
        <thead class="table-secondary">
            <tr>
                <th>#</th>
                <th>Flight No.</th>
                <th>Departure</th>
                <th>Destination</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->flight->flight_number }}</td>
                    <td>{{ $booking->flight->departure }}</td>
                    <td>{{ $booking->flight->destination }}</td>
                    <td>
                        <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : 'warning' }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
