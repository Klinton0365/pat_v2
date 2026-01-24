<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    // public function authenticate(Request $request)
    // {
    //     // dd('recieved');
    //     // Validate input
    //     $credentials = $request->validate([
    //         'email'    => ['required', 'email'],
    //         'password' => ['required', 'string'],
    //     ]);

    //     // Step 1: Find user by email
    //     $user = User::where('email', $credentials['email'])->first();
    //     // dd($user);

    //     if (!$user || !Hash::check($credentials['password'], $user->password)) {
    //         // dd('USersss');
    //         return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    //     }

    //     // Step 2: Check if this user is an admin
    //     $admin = Admin::where('user_id', $user->id)->where('is_active', true)->first();

    //     if (!$admin) {
    //         dd('admin illa');
    //         return back()->withErrors(['email' => 'You are not authorized as an admin.']);
    //     }

    //     // Step 3: Log the user in
    //     Auth::login($user, $request->filled('remember'));

    //     // Step 4: Redirect to dashboard
    //     return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
    // }

    public function authenticate(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Step 1: Find user by email
        $user = User::where('email', $credentials['email'])->first();
        // dd($user);

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            dd('Invalid');

            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        }

        // Step 2: Check if this user is an admin
        $admin = Admin::where('user_id', $user->id)
            ->where('is_active', true)
            ->first();
        // dd('ADMIN', $admin);

        if (! $admin) {
            dd($admin);

            return back()->withErrors(['email' => 'You are not authorized as an admin.']);
        }
        // DD('AFTER');

        // Step 3: Log in admin with the admin guard
        Auth::guard('admin')->login($admin, $request->filled('remember'));

        // Step 4: Redirect to dashboard
        return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome Admin!');
    }

    /**
     * Admin Dashboard
     */
    // public function dashboard()
    // {
    //     return view('admin.dashboard');
    // }

    public function dashboard()
    {
        // Products & Categories
        $categoryCount = Category::count();
        $productCount = Product::count();

        // Users / Customers
        $userCount = User::count();
        $customerCount = Customer::count();

        // Orders
        $totalOrders = Order::count();
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $deliveredOrders = Order::where('order_status', 'delivered')->count();
        $todayOrders = Order::whereDate('created_at', today())->count();

        // Revenue
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $todayRevenue = Order::where('payment_status', 'paid')
            ->whereDate('payment_date', today())
            ->sum('total_amount');

        // Services
        $totalServices = Service::count();
        $pendingServices = Service::where('status', 'pending')->count();
        $inProgressServices = Service::where('status', 'in_progress')->count();
        $completedServices = Service::where('status', 'completed')->count();
        $cancelledServices = Service::where('status', 'cancelled')->count();

        // Upcoming services within 7 days
        $upcomingServices = Service::whereNotNull('next_service_date')
            ->whereBetween('next_service_date', [now(), now()->addDays(7)])
            ->count();

        // Overdue services (follow-up needed)
        $overdueServices = Service::whereNotNull('next_service_date')
            ->where('next_service_date', '<', today())
            ->where('status', '!=', 'completed')
            ->count();

        // Booking services table
        $bookingCount = DB::table('service_bookings')->count();

        $recentOrders = Order::with('user')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

        return view('admin.dashboard', compact(
            'categoryCount', 'productCount', 'userCount', 'customerCount',
            'totalOrders', 'pendingOrders', 'todayOrders', 'totalRevenue', 'todayRevenue',
            'totalServices','deliveredOrders', 'pendingServices', 'inProgressServices', 'completedServices',
            'cancelledServices', 'upcomingServices', 'overdueServices', 'bookingCount','recentOrders'
        ));
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
