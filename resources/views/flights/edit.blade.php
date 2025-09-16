<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Flight</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

<div class="d-flex">

    <!-- Sidebar -->
    <aside class="bg-primary text-white p-3 flex-shrink-0" style="width: 250px; min-height: 100vh;">
        <h3 class="fw-bold mb-4">Admin Dashboard</h3>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="d-block mb-2 text-white">Dashboard</a>
            <a href="{{ route('flights.index') }}" class="d-block mb-2 text-white">Flights</a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-light w-100">Logout</button>
        </form>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4">

        <!-- Navbar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Edit Flight</h2>
            <a href="{{ route('flights.index') }}" class="btn btn-secondary">Back to Flights</a>
        </div>

        <!-- Form -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('flights.update', $flight->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="flight_number" class="form-label">Flight Number</label>
                <input type="text" name="flight_number" id="flight_number" class="form-control" value="{{ old('flight_number', $flight->flight_number) }}">
            </div>

            <div class="mb-3">
                <label for="departure" class="form-label">Departure</label>
                <input type="text" name="departure" id="departure" class="form-control" value="{{ old('departure', $flight->departure) }}">
            </div>

            <div class="mb-3">
                <label for="destination" class="form-label">Destination</label>
                <input type="text" name="destination" id="destination" class="form-control" value="{{ old('destination', $flight->destination) }}">
            </div>

            <div class="mb-3">
                <label for="departure_time" class="form-label">Departure Time</label>
                <input type="datetime-local" name="departure_time" id="departure_time" class="form-control" value="{{ old('departure_time', date('Y-m-d\TH:i', strtotime($flight->departure_time))) }}">
            </div>

            <div class="mb-3">
                <label for="arrival_time" class="form-label">Arrival Time</label>
                <input type="datetime-local" name="arrival_time" id="arrival_time" class="form-control" value="{{ old('arrival_time', date('Y-m-d\TH:i', strtotime($flight->arrival_time))) }}">
            </div>

            <button type="submit" class="btn btn-success">Update Flight</button>
        </form>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

</body>
</html>