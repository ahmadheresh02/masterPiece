<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectAdminToAdminDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is logged in and is an admin
        if (Auth::check() && Auth::user()->is_admin) {
            // Skip redirect only if already on admin routes
            if (!$request->routeIs('admin.*')) {
                return redirect()->route('admin.dashboard');
            }
        }

        return $next($request);
    }
}
