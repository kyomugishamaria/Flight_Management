<div class="top-navbar d-flex justify-content-between align-items-center">
  <button class="btn btn-outline-primary d-lg-none me-3" onclick="openSidebar()">
    <i class="bi bi-list"></i>
  </button>
  <div>
    <h1 class="h5">✈️ Admin Dashboard</h1>
    <p>Welcome, {{ Auth::user()->first_name. ' '.Auth::user()->last_name }}</p>
  </div>
  <form class="d-flex" role="search">
    <input class="form-control me-2" type="search" placeholder="Search...">
    <button class="btn btn-primary" type="submit">Search</button>
  </form>
</div>
