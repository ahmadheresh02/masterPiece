<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\InternshipListing;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics for the dashboard
        $stats = [
            'users' => User::count(),
            'companies' => Company::count(),
            'listings' => InternshipListing::count(),
            'applications' => Application::count(),
        ];

        // Recent users
        $recentUsers = User::latest()->take(5)->get();

        // Recent companies
        $recentCompanies = Company::latest()->take(5)->get();

        // Recent internship listings
        $recentListings = InternshipListing::with('company')
            ->latest()
            ->take(5)
            ->get();

        // Recent applications
        $recentApplications = Application::with(['user', 'internshipListing.company'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentUsers',
            'recentCompanies',
            'recentListings',
            'recentApplications'
        ));
    }
}
