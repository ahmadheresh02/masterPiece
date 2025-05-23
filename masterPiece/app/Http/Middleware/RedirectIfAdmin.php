<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
    /**
     * Redirect admins to admin dashboard if they try to access regular user pages.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is logged in and is an admin
        if (Auth::check() && Auth::user()->is_admin) {
            // Allow access to logout, admin routes, and API routes
            if (
                $request->routeIs('logout') ||
                $request->routeIs('admin.*') ||
                $request->is('api/*')
            ) {
                return $next($request);
            }

            // Redirect to admin dashboard
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
