<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     * Redirect non-admin users to the dashboard with a 403-like message.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user || ! data_get($user, 'is_admin')) {
            // If the request expects JSON, return 403 JSON
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Forbidden.'], 403);
            }

            // Otherwise redirect back to dashboard with an error flash
            return Redirect::route('dashboard')->with('error', 'You are not authorized to access that page.');
        }

        return $next($request);
    }
}
