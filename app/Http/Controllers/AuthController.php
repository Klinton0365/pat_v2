<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        // dd('sdfsdfsd');
        $categories = Category::withCount('products')
           // ->where('status', 'active')
            ->get();

        // dd('dfsdf');
        return view('user.auth.register', compact('categories'));
    }

    /**
     * Register new user
     */
    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip' => 'nullable|string',
            'country' => 'nullable|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'password' => Hash::make($request->password),
        ]);

        // Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Login user
     */
    public function showLoginForm()
    {
        $categories = Category::withCount('products')
           // ->where('status', 'active')
            ->get();

        return view('user.auth.login', compact('categories'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if user already exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if (! $user) {
                // Create new user
                $user = User::create([
                    'first_name' => $googleUser->user['given_name'] ?? $googleUser->getName(),
                    'last_name' => $googleUser->user['family_name'] ?? '',
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(16)), // random password
                    'google_id' => $googleUser->getId(),
                ]);
            }

            Auth::login($user);

            return redirect()->route('home')->with('success', 'Logged in successfully with Google!');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google login failed. Please try again.');
        }
    }

    /**
     * Get logged-in user profile
     */
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }
}
