<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function handle($request, Closure $next)
    {
        \Log::info('AuthenticateUser middleware triggered', [
            'user' => Auth::user(),
            'url' => $request->url(),
        ]);

        if (! Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'redirect' => route('login'),
                    'message' => 'Please log in to continue.',
                ], 401);
            }

            return redirect()->route('login');
        }

        return $next($request);
    }

    // public function handle($request, Closure $next)
    // {
    //     if (!Auth::check()) {
    //         \Log::info('AUTHERNTICATION');
    //         if ($request->expectsJson()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'redirect' => route('login'),
    //                 'message' => 'Please log in to continue.'
    //             ], 401);
    //         }

    //         return redirect()->route('login');
    //     }

    //     return $next($request);
    // }

}
