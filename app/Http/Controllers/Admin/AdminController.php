<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Show admin login form
     */
    public function showLoginForm()
    {
        return view('admin.auth.signin');
    }

    /**
     * Handle admin login
     */
    public function authenticate(Request $request)
    {
        // dd('recieved');
        // Validate input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Step 1: Find user by email
        $user = User::where('email', $credentials['email'])->first();
        // dd($user);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            // dd('USersss');
            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        }

        // Step 2: Check if this user is an admin
        $admin = Admin::where('user_id', $user->id)->where('is_active', true)->first();

        if (!$admin) {
            dd('admin illa');
            return back()->withErrors(['email' => 'You are not authorized as an admin.']);
        }

        // Step 3: Log the user in
        Auth::login($user, $request->filled('remember'));

        // Step 4: Redirect to dashboard
        return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
    }

    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
