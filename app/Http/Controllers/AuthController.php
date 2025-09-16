<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\Flight;
use App\Models\Passenger;

class AuthController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegister()
    {
        // Prepare counts to control role availability in Blade
        $staffCount = User::where('role', 'staff')->count();
        $adminCount = User::where('role', 'admin')->count();

        return view('auth.register', compact('staffCount', 'adminCount'));
    }

    /**
     * Handle user registration (admin + staff only)
     */
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:6|confirmed',
            'role'       => 'required|in:admin,staff',
        ]);

        // Role limits
        if ($request->role === 'admin' && User::where('role', 'admin')->count() >= 1) {
            return back()->withErrors(['role' => 'Only one admin account is allowed.']);
        }

        if ($request->role === 'staff' && User::where('role', 'staff')->count() >= 5) {
            return back()->withErrors(['role' => 'Maximum of five staff members exceeded.']);
        }

        // Create user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'role'       => $request->role,
            'password'   => Hash::make($request->password),
        ]);

        // Log them in
        Auth::login($user);

        return $this->redirectToDashboard($user);
    }

    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectToDashboard(Auth::user());
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    /**
     * Forgot password form
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send reset link
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Show reset form
     */
    public function showResetPassword($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Redirect based on role
     */
    protected function redirectToDashboard($user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'staff') {
            return redirect()->route('staff.dashboard');
        } else {
            Auth::logout();
            return redirect()->route('login')->withErrors(['role' => 'Invalid role']);
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Admin dashboard
     */
    public function adminDashboard()
    {
        $totalPassengers = Passenger::count();
        $totalFlights    = Flight::count();
        $flights         = Flight::orderBy('departure_time')->get();

        return view('dashboards.admin', compact('totalPassengers', 'totalFlights', 'flights'));
    }

    /**
     * Staff dashboard
     */
    public function staffDashboard()
    {
        return view('dashboards.staff');
    }
}
