@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <!-- Dashboard Cards -->
  <div class="card-container mb-4">
    <h2 class="h5 mb-4">Overview</h2>
    <div class="row g-4">
      <div class="col-sm-6 col-lg-3">
        <div class="card dashboard-card p-3">
          <i class="bi bi-people-fill text-primary dashboard-icon"></i>
          <h6>Passengers</h6>
          <h2>{{ $passengersCount ?? 0 }}</h2>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card dashboard-card p-3">
          <i class="bi bi-ticket-perforated-fill text-success dashboard-icon"></i>
          <h6>Tickets</h6>
          <h2>{{ $ticketsCount ?? 0 }}</h2>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card dashboard-card p-3">
          <i class="bi bi-airplane-fill text-danger dashboard-icon"></i>
          <h6>Flights</h6>
          <h2>{{ $totalFlights ?? 0 }}</h2>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card dashboard-card p-3">
          <i class="bi bi-currency-dollar text-warning dashboard-icon"></i>
          <h6>Revenue</h6>
          <h2>{{ $revenueCount ?? 0 }}</h2>
        </div>
      </div>
    </div>
  </div>

  <!-- Flights table -->
  <div>
    <h2 class="mb-4">Flights Overview</h2>

    @if($flights->isEmpty())
      <div class="alert alert-info">No flights available.</div>
    @else
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead class="table-header">
            <tr>
              <th>#</th>
              <th>Flight Number</th>
              <th>Departure</th>
              <th>Destination</th>
              <th>Departure Time</th>
              <th>Arrival Time</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($flights as $flight)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $flight->flight_number }}</td>
              <td>{{ $flight->departure }}</td>
              <td>{{ $flight->destination }}</td>
              <td>{{ \Carbon\Carbon::parse($flight->departure_time)->format('d M Y, H:i') }}</td>
              <td>{{ \Carbon\Carbon::parse($flight->arrival_time)->format('d M Y, H:i') }}</td>
              <td>
                <a href="{{ route('flights.edit', $flight->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('flights.destroy', $flight->id) }}" method="POST" class="d-inline delete-form">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="btn btn-sm btn-danger btn-delete">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
