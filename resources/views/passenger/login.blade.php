<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Login</title>
    @vite('resources/css/app.css') <!-- Laravel 12 with Vite for Tailwind -->
</head>
<body class="bg-gradient-to-r from-blue-600 to-indigo-700 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-3xl font-bold text-center text-indigo-700 mb-6">Passenger Login</h2>

        <!-- Login Form -->
        <form action="{{ route('passenger.login.post') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter your email"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required>
            </div>

            <!-- Login Button -->
            <button type="submit"
                class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 transition duration-300">
                Login
            </button>

            <!-- Extra Links -->
            <div class="flex justify-between text-sm text-gray-600 mt-3">
                <a href="{{ route('passenger.register') }}" class="hover:text-indigo-600">Create an Account</a>
                <a href="{{ route('passenger.password.request') }}" class="hover:text-indigo-600">Forgot Password?</a>
            </div>
        </form>
    </div>

</body>
</html>
