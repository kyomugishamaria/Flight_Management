<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
   <link rel="stylesheet" href="{{ asset('css/custom.css?v=1') }}"> 
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

<div class="d-flex">
  <!-- Sidebar -->
  <aside class="sidebar p-3 flex-shrink-0" id="sidebar">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="fw-bold">Passengers<br> & Travels</h3>
      <span class="close-btn d-lg-none" onclick="closeSidebar()">&times;</span>
    </div>
    <nav>
      <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
      <a href="#"><i class="bi bi-people me-2"></i> Passengers</a>
      <a href="#"><i class="bi bi-ticket-detailed me-2"></i> Tickets</a>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="flightsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-airplane me-2"></i> Flights
        </a>
        <ul class="dropdown-menu" aria-labelledby="flightsDropdown">
          <li><a class="dropdown-item" href="{{ route('flights.index') }}">All Flights</a></li>
          <li><a class="dropdown-item" href="{{ route('flights.create') }}">Add New Flight</a></li>
          <li><a class="dropdown-item" href="#">Flight Schedule</a></li>
          <li><a class="dropdown-item" href="#">Flight Reports</a></li>
        </ul>
      </li>
      <a href="#"><i class="bi bi-gear me-2"></i> Settings</a>
    </nav>
    <form action="" method="POST" class="mt-4">
      <button type="submit" class="btn btn-light w-100">Logout</button>
    </form>
  </aside>

  <!-- Overlay for small screens -->
  <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

  <!-- Main Content -->
  <div class="flex-grow-1">
    <!-- Navbar -->
    <div class="top-navbar d-flex justify-content-between align-items-center">
      <button class="btn btn-outline-primary d-lg-none me-3" onclick="openSidebar()">
        <i class="bi bi-list"></i>
      </button>
      <div>
        <h1 class="h5">✈️ Admin Dashboard</h1>
        <p>Welcome, Admin!</p>
      </div>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search...">
        <button class="btn btn-primary" type="submit">Search</button>
      </form>
    </div>

    <!-- Dashboard Cards -->
    <div class="container my-4">
      <div class="card-container">
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
    </div>

    <!-- Flights table -->
    <div class="container my-4">
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
  </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');

  function openSidebar() {
    sidebar.classList.add('show');
    overlay.classList.add('show');
  }
  function closeSidebar() {
    sidebar.classList.remove('show');
    overlay.classList.remove('show');
  }

  // SweetAlert flash messages
  @if(session('success'))
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: @json(session('success')),
      confirmButtonText: 'OK'
    });
  @endif

  @if(session('error'))
    Swal.fire({
      icon: 'error',
      title: 'Oops!',
      text: @json(session('error')),
      confirmButtonText: 'Try Again'
    });
  @endif

  // SweetAlert Delete confirmation
  document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function (e) {
      const form = this.closest('form');
      Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });
</script>

</body>
</html>
