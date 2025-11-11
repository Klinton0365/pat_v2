<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        // ✅ 1. If NOT logged in as admin, redirect to login
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')
                             ->withErrors(['access' => 'Please log in as an admin.']);
        }

        // ✅ 2. If logged in, verify admin is still active
        $admin = Auth::guard('admin')->user();

        if (!$admin->is_active) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')
                             ->withErrors(['access' => 'Your admin account is inactive.']);
        }

        // ✅ 3. Continue request
        return $next($request);
    }
}
