<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard')</title>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/custom.css?v=1') }}">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
<div class="d-flex">
  
  <!-- Sidebar -->
  @include('layouts.sidebar')

  <!-- Overlay -->
  <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

  <!-- Main Content -->
  <div class="flex-grow-1">
    
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Page Content -->
    <main class="container-fluid py-4">
      @yield('content')
    </main>
    
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

  // Flash Messages
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
</script>
</body>
</html>
