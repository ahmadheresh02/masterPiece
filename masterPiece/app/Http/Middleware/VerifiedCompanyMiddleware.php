<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

class VerifiedCompanyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if authenticated user is a company
        $company = null;
        $isCompanyUser = false;

        // Check if logged in through the company guard
        if (Auth::guard('company')->check()) {
            $company = Auth::guard('company')->user();
            $isCompanyUser = true;
        }
        // Check if logged in through web guard
        else if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            // Direct company login - Auth::user() is already a Company
            if ($user instanceof Company) {
                $company = $user;
                $isCompanyUser = true;
            }
            // User with company relation - for potential future use
            elseif (method_exists($user, 'company') && $user->company) {
                $company = $user->company;
                $isCompanyUser = true;
            }
        }

        // Only redirect to awaiting-approval if user is actually a company and not verified
        if ($isCompanyUser && (!$company || !$company->is_verified)) {
            return redirect()->route('company.awaiting-approval');
        }

        return $next($request);
    }
}
