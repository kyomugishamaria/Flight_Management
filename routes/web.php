<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PassengerAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// -----------------
// Welcome / Role Selection
// -----------------
Route::get('/', function () {
    return view('auth.role_selection');
})->name('role.selection');


// =====================
// USER (Admin / Staff) AUTH
// =====================

// Registration
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Password Reset
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// =====================
// User Dashboards (Admin / Staff)
// =====================
Route::middleware('auth')->group(function() {

    // Unified dashboard redirect based on role
    Route::get('/dashboard', function() {
        $user = Auth::user();
        switch($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            default:
                Auth::logout();
                return redirect()->route('login');
        }
    })->name('dashboard');

    // Admin dashboard
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');

    // Staff dashboard
    Route::get('/staff/dashboard', [AuthController::class, 'staffDashboard'])->name('staff.dashboard');
});


// =====================
// PASSENGER AUTH
// =====================
Route::prefix('passenger')->group(function() {

    // Guest (not logged-in) routes
    Route::middleware('guest:passenger')->group(function () {
        Route::get('login', [PassengerAuthController::class, 'showLoginForm'])->name('passenger.login');
        Route::post('login', [PassengerAuthController::class, 'login'])->name('passenger.login.post');

        Route::get('register', [PassengerAuthController::class, 'showRegisterForm'])->name('passenger.register');
        Route::post('register', [PassengerAuthController::class, 'register'])->name('passenger.register.post');

        Route::get('forgot-password', [PassengerAuthController::class, 'showForgotPasswordForm'])
            ->name('passenger.password.request');
        Route::post('forgot-password', [PassengerAuthController::class, 'sendResetLink'])
            ->name('passenger.password.email');
        Route::get('reset-password/{token}', [PassengerAuthController::class, 'showResetForm'])
            ->name('passenger.password.reset');
        Route::post('reset-password', [PassengerAuthController::class, 'resetPassword'])
            ->name('passenger.password.update');
    });

    // Authenticated passenger routes
    Route::middleware('auth:passenger')->group(function () {
        Route::post('logout', [PassengerAuthController::class, 'logout'])->name('passenger.logout');
        Route::get('dashboard', [PassengerAuthController::class, 'dashboard'])->name('passenger.dashboard');

        // Passenger flights and bookings
        Route::get('flights', [BookingController::class, 'index'])->name('passengers.flights');
        Route::post('flights/{flight}/book', [BookingController::class, 'store'])->name('passengers.flights.book');
        Route::get('bookings', [BookingController::class, 'myBookings'])->name('passengers.bookings');
    });
});


// =====================
// ADMIN FLIGHT MANAGEMENT
// =====================
Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('flights', [FlightController::class, 'index'])->name('flights.index');
    Route::get('flights/create', [FlightController::class, 'create'])->name('flights.create');
    Route::post('flights', [FlightController::class, 'store'])->name('flights.store');
    Route::get('flights/{flight}/edit', [FlightController::class, 'edit'])->name('flights.edit');
    Route::put('flights/{flight}', [FlightController::class, 'update'])->name('flights.update');
    Route::delete('flights/{flight}', [FlightController::class, 'destroy'])->name('flights.destroy');
});


// =====================
// ADMIN SEARCH (Optional)
// =====================
Route::get('/search', [AdminDashboardController::class, 'search'])->middleware('auth')->name('search');
