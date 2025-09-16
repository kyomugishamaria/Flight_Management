<!-- resources/views/auth/role-selection.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <body class="min-h-screen flex items-center justify-center bg-gray-100">

    <!-- Background Image with Blue Overlay -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/logo2.png') }}" alt="Background"
             class="w-full h-full object-cover"/>
        <div class="absolute inset-0 bg-blue-900 opacity-50"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-4">
        {{-- <h1 class="text-4xl font-bold text-white mb-12">Select Your Role</h1> --}}
        <h1 class="text-4xl font-bold text-white mb-12 relative -top-20  animate-fadeInUp">Welcome To PATMS</h1>


        <div class="flex flex-col sm:flex-row space-y-6 sm:space-y-0 sm:space-x-12">
            
            <!-- Users (Admin/Staff) -->
            <a href="{{ route('login') }}" 
               class="w-56 h-56 flex flex-col items-center justify-center bg-white rounded-full shadow-lg hover:shadow-2xl transform hover:scale-105 transition">
                <img src="https://img.icons8.com/ios-filled/100/000000/conference-call.png" class="w-20 h-20 mb-4"/>
                <h2 class="text-xl font-bold">Users</h2>
                <p class="text-sm text-gray-500">Admin & Staff</p>
            </a>

            <!-- Passengers -->
            <a href="{{ route('passenger.login') }}" 
               class="w-56 h-56 flex flex-col items-center justify-center bg-white rounded-full shadow-lg hover:shadow-2xl transform hover:scale-105 transition">
                <img src="https://img.icons8.com/ios-filled/100/000000/airport.png" class="w-20 h-20 mb-4"/>
                <h2 class="text-xl font-bold">Passengers</h2>
                <p class="text-sm text-gray-500">Passenger Login</p>
            </a>

        </div>
    </div>
</body>
</html>
