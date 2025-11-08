<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    // public function handle($request, Closure $next)
    // {
    //     // dd($request->all(), $next);
    //     \Log::info('AuthenticateUser middleware triggered', [
    //         'user' => Auth::user(),
    //         'url' => $request->url(),
    //     ]);

    //     if (! Auth::check()) {
    //         if ($request->expectsJson()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'redirect' => route('login'),
    //                 'message' => 'Please log in to continue.',
    //             ], 401);
    //         }

    //         return redirect()->route('login');
    //     }

    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        // Debug log (optional)
        \Log::info('AuthenticateUser middleware triggered', [
            'user' => Auth::user(),
            'url' => $request->url(),
        ]);

        // If not logged in
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'redirect' => route('login'),
                    'message' => 'Please log in to continue.'
                ], 401);
            }

            // Remember intended route for redirect after login
            $request->session()->put('url.intended', url()->current());

            return redirect()->route('login')
                ->with('error', 'Please log in to continue.');
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
