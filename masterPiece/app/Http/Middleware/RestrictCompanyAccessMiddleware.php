<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

class RestrictCompanyAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if authenticated user is a company
        $isCompany = false;

        // Check if logged in through the company guard
        if (Auth::guard('company')->check()) {
            $isCompany = true;
        }
        // Check if logged in through web guard with company relation
        else if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            $isCompany = $user instanceof Company || (method_exists($user, 'company') && $user->company);
        }

        // If user is a company, check if they are accessing allowed routes
        if ($isCompany) {
            // List of allowed routes for companies
            $allowedRoutes = [
                'company.dashboard',
                'company.awaiting-approval',
                'applicant.profile',
                'internships.create',
                'internships.store',
                'internships.edit',
                'internships.update',
                'internships.destroy',
                'internships.show',
                'internships.index',
                'internships.applications.index',
                'applications.show',
                'applications.updateStatus',
                'logout',
                'profile.show',
                'profile.edit',
                'profile.update'
            ];

            // Check if current route name is in the allowed routes
            $currentRoute = $request->route()->getName();

            if (!in_array($currentRoute, $allowedRoutes)) {
                return redirect()->route('company.dashboard');
            }
        }

        // If not a company user, let them through without restrictions
        return $next($request);
    }
}
