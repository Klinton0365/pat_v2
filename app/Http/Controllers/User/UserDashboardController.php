<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserDashboardController extends Controller
{
    public function dashboardIndex()
    {
        $userId = Auth::id();
        $customer = Auth::user()->customer;

        return view('user.dashboard.dashboard', [
            'totalOrders' => Order::where('user_id', $userId)->count(),
            'pendingOrders' => Order::where('user_id', $userId)->where('order_status', 'pending')->count(),
            'activeServices' => Service::where('customer_id', $customer->id)->where('status', 'in_progress')->count(),
            'upcomingServices' => Service::where('customer_id', $customer->id)
                ->whereDate('next_service_date', '>=', now())
                ->count(),
        ]);
    }

    public function orderIndex()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    // public function orderShow(Order $order)
    // {
    //     if ($order->user_id !== Auth::id()) {
    //         abort(403);
    //     }

    //     $order->load('items.product');

    //     return view('user.orders.show', compact('order'));
    // }
    public function orderShow($id)
{
    // Fetch order only if it belongs to the authenticated user
    $order = Order::where('id', $id)
        ->where('user_id', Auth::id())
        ->with(['items.product'])
        ->first();

    // If no order found or unauthorized
    if (! $order) {
        abort(403, 'Unauthorized access to this order.');
    }

    return view('user.orders.show', compact('order'));
}


    public function profileIndex()
    {
        return view('user.dashboard.profile');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        Auth::user()->update($request->all());

        return back()->with('success', 'Profile updated successfully!');
    }

    public function serviceIndex()
    {
        $services = Service::where('customer_id', Auth::user()->customer->id)
            ->latest()
            ->paginate(10);

        return view('user.services.index', compact('services'));
    }

    public function serviceShow(Service $service)
    {
        // dd('dhfisd');
        if ($service->customer_id !== Auth::user()->customer->id) {
            abort(403);
        }

        return view('user.services.show', compact('service'));
    }
}
