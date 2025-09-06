<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            $isAdmin = Admin::where('user_id', $user->id)->where('is_active', true)->exists();

            if ($isAdmin) {
                return $next($request);
            }
        }

        return redirect()->route('admin.login')->withErrors('Access denied. Admins only.');
    }
}
