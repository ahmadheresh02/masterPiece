<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        // Only redirect to company dashboard if user is logged in through company guard
        if (Auth::guard('company')->check()) {
            try {
                return redirect()->route('company.dashboard');
            } catch (\Exception $e) {
                // Log the error
                \Log::error('Failed to redirect to company dashboard: ' . $e->getMessage());
                // Fallback to home view
                return view('home')->with('error', 'Could not access company dashboard. Please try again later.');
            }
        }

        // Check if user is associated with a company AND is explicitly marked as a company owner/admin
        if ($user && isset($user->is_company_owner) && $user->is_company_owner) {
            try {
                return redirect()->route('company.dashboard');
            } catch (\Exception $e) {
                // Log the error
                \Log::error('Failed to redirect company owner to dashboard: ' . $e->getMessage());
                return view('home')->with('error', 'Could not access company dashboard. Please try again later.');
            }
        }

        // Check if user is admin
        if ($user && isset($user->is_admin) && $user->is_admin) {
            try {
                return redirect()->route('admin.dashboard');
            } catch (\Exception $e) {
                \Log::error('Failed to redirect admin to dashboard: ' . $e->getMessage());
                return view('home')->with('error', 'Could not access admin dashboard. Please try again later.');
            }
        }

        // Regular users should see the home view
        return view('home');
    }
}
