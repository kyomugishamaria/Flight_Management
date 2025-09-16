<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passenger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\Flight;
use App\Models\Booking;



class PassengerAuthController extends Controller
{
     // Show register form
    public function showRegisterForm() {
        return view('passenger.register');
    }

    // Handle registration
    public function register(Request $request) {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:passengers,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $passenger = Passenger::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('passenger')->login($passenger);

        return redirect()->route('passenger.dashboard');
    }



    // Show login form
    public function showLoginForm() {
        return view('passenger.login');
    }

    // Handle login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('passenger')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('passenger.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

   
    // Logout
    public function logout(Request $request) {
        Auth::guard('passenger')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('passenger.login');
    }

    // Forgot Password
    public function showForgotPasswordForm() {
        return view('passenger.forgot-password');
    }

    public function sendResetLink(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('passengers')->sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    // Show reset form
    public function showResetForm($token) {
        return view('passenger.reset-password', ['token' => $token]);
    }

    // Reset password
    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::broker('passengers')->reset(
            $request->only('email','password','password_confirmation','token'),
            function ($passenger, $password) {
                $passenger->password = Hash::make($password);
                $passenger->save();

                Auth::guard('passenger')->login($passenger);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('passenger.dashboard')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }


     // Dashboard
    public function dashboard() {
    $passenger = Auth::guard('passenger')->user(); 
    return view('dashboards.passenger', compact('passenger'));
}

    
}
