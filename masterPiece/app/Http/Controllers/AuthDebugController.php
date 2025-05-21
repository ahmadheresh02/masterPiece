<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthDebugController extends Controller
{
    /**
     * Display debug information about the current authentication state
     */
    public function debug()
    {
        $output = [];

        // Check if user is logged in
        $output['is_authenticated'] = Auth::check();

        // Get the authenticated user
        $user = Auth::user();
        $output['auth_user_type'] = $user ? get_class($user) : 'Not authenticated';

        // Check if user is a company
        $output['is_company'] = $user instanceof \App\Models\Company;

        // Check if user has a company relationship
        $output['has_company_relation'] = isset($user->company);

        // If user has a company relation, check its type
        if (isset($user->company)) {
            $output['company_relation_type'] = get_class($user->company);
        }

        // Return view with debug information
        return view('auth-debug', ['debug' => $output]);
    }
}
