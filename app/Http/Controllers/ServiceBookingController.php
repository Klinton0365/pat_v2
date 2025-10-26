<?php

// app/Http/Controllers/ServiceBookingController.php

namespace App\Http\Controllers;

use App\Models\ServiceBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ServiceBookingController extends Controller
{
    public function index()
    {
        return view('frontend.services');
    }

    public function store(Request $request)
    {
        \Log::info('Booking', $request->all());
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|email',
            'service_type' => 'required|string',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
        ]);

        // Split the name if possible
        $nameParts = explode(' ', $request->name);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        // Check existing user by email or phone
        $existingUser = User::where('email', $request->email)
            ->orWhere('phone', $request->phone)
            ->first();

        if ($existingUser) {
            $user = $existingUser;
        } else {
            // Create new user
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $request->email ?? $request->phone.'@noreply.com',
                'phone' => $request->phone,
                'password' => Hash::make('123456'), // default or temporary password
                'address' => $request->address,
                'city' => null,
                'state' => null,
                'zip' => null,
                'country' => null,
            ]);
        }

        // Store booking
        ServiceBooking::create([
            'user_id' => $user->id,
            'service_type' => $request->service_type,
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json([
            'success' => true,
            'message' => $existingUser
                ? 'Booking added for existing user.'
                : 'New user created and service booked successfully!',
        ]);
    }
}
