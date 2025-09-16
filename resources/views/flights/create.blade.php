{{-- resources/views/flights/create.blade.php --}}
@extends('layouts.app') {{-- Uses your main layout with sidebar/navbar --}}

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span><i class="bi bi-plus-circle me-2"></i>Add New Flight</span>
            <a href="{{ route('flights.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left-circle me-1"></i> Back to Flights
            </a>
        </div>
        <div class="card-body">

            {{-- Display Validation Errors --}}
            @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-start shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                <div>
                    <strong>Oops! Something went wrong:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- Flight Create Form --}}
            <form action="{{ route('flights.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="flight_number" class="form-label">Flight Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-airplane"></i></span>
                        <input type="text" name="flight_number" id="flight_number" class="form-control" value="{{ old('flight_number') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="departure" class="form-label">Departure</label>
                    <input type="text" name="departure" id="departure" class="form-control" value="{{ old('departure') }}">
                </div>

                <div class="mb-3">
                    <label for="destination" class="form-label">Destination</label>
                    <input type="text" name="destination" id="destination" class="form-control" value="{{ old('destination') }}">
                </div>

                <div class="mb-3">
                    <label for="departure_time" class="form-label">Departure Time</label>
                    <input type="datetime-local" name="departure_time" id="departure_time" class="form-control" value="{{ old('departure_time') }}">
                </div>

                <div class="mb-3">
                    <label for="arrival_time" class="form-label">Arrival Time</label>
                    <input type="datetime-local" name="arrival_time" id="arrival_time" class="form-control" value="{{ old('arrival_time') }}">
                </div>

                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-save2 me-1"></i> Save Flight
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
