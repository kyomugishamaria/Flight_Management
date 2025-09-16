<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Passenger Registration</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Passenger Registration</h2>

    <form action="{{ route('passenger.register.post') }}" method="POST" class="space-y-4">
      @csrf
      
      <!-- First Name -->
      <div>
        <label class="block text-gray-600 mb-1">First Name</label>
        <input type="text" name="first_name" placeholder="Enter First Name" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      <!-- Last Name -->
      <div>
        <label class="block text-gray-600 mb-1">Last Name</label>
        <input type="text" name="last_name" placeholder="Enter Last Name" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      <!-- Email -->
      <div>
        <label class="block text-gray-600 mb-1">Email</label>
        <input type="email" name="email" placeholder="Enter Email" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      <!-- Phone -->
      <div>
        <label class="block text-gray-600 mb-1">Phone Number</label>
        <input type="text" name="phone_number" placeholder="Enter Phone Number" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      <!-- Password -->
      <div>
        <label class="block text-gray-600 mb-1">Password</label>
        <input type="password" name="password" placeholder="Enter Password" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      <!-- Confirm Password -->
      <div>
        <label class="block text-gray-600 mb-1">Confirm Password</label>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      <!-- Submit Button -->
      <button type="submit" 
        class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition duration-300">
        Register
      </button>
    </form>

    <!-- Extra Links -->
    <p class="text-sm text-gray-500 text-center mt-4">
      Already have an account? 
      <a href="{{ route('passenger.login') }}" class="text-blue-500 hover:underline">Login here</a>
    </p>
  </div>

</body>
</html>
