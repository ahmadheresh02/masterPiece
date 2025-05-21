<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\InternshipListing;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Use the company guard for authentication
        $this->middleware(['auth:web,company'])->except(['redirectToDashboard']);
    }

    /**
     * Redirects to the proper dashboard
     */
    public function redirectToDashboard()
    {
        // Check both the web and company guards
        if (!Auth::guard('web')->check() && !Auth::guard('company')->check()) {
            return redirect()->route('login')->with('intended', route('company.dashboard'));
        }

        return $this->index();
    }

    /**
     * Display the company dashboard
     */
    public function index()
    {
        // Check both the web and company guards
        if (!Auth::guard('web')->check() && !Auth::guard('company')->check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to access the dashboard')
                ->with('intended', route('company.dashboard'));
        }

        $company = null;

        // Check if logged in through the company guard
        if (Auth::guard('company')->check()) {
            $company = Auth::guard('company')->user();
        }
        // Check if logged in through web guard
        else if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            // Direct company login - Auth::user() is already a Company
            if ($user instanceof Company) {
                $company = $user;
            }
            // User with company relation - for potential future use
            elseif (method_exists($user, 'company') && $user->company) {
                $company = $user->company;
            }
        }

        // If no company was found, redirect to login
        if (!$company) {
            return redirect()->route('login')->with('error', 'No company profile found. Please log in with a company account.');
        }

        // Get company's internship listings
        $internships = InternshipListing::where('company_id', $company->id)
            ->withCount('applications')
            ->latest()
            ->get();

        // Get statistics for dashboard
        $activeListing = $internships->where('is_active', true)->count();

        // Get all applications for this company's listings
        $applications = Application::whereIn('listing_id', $internships->pluck('id'))
            ->with(['user', 'internshipListing'])
            ->get();

        $totalApplications = $applications->count();

        // Count applications by status
        $underReview = $applications->where('status', 'under_review')->count();
        $shortlisted = $applications->where('status', 'shortlisted')->count();

        // Get recent applications
        $recentApplications = $applications->sortByDesc('created_at')->take(5);

        return view('Company-Dashboard', compact(
            'company',
            'internships',
            'activeListing',
            'totalApplications',
            'underReview',
            'shortlisted',
            'recentApplications'
        ));
    }
}
