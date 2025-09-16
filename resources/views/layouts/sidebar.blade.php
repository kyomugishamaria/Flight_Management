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
