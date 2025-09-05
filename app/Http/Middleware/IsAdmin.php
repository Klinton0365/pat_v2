<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Assuming your "admins" table is linked to users
        $user = $request->user();
        dd($user);
        if (!$user || !$user->admin) { // if no related admin
            abort(403, 'Access denied. Admins only.');
        }

        // Optional: check role
        if ($user->admin->role !== 'super_admin') {
            abort(403, 'You do not have the required admin privileges.');
        }

        return $next($request);
    }
}
