<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers {
        logout as traitLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Get the post login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        // If user is a company, redirect to company dashboard
        if (Auth::guard('company')->check()) {
            return route('company.dashboard');
        }

        // Check if there's an intended URL
        if (session()->has('intended')) {
            return session()->pull('intended');
        }

        // Default redirect for regular users
        return $this->redirectTo;
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Check if the user exists in the users table
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If user not found, check in the companies table
        $company = Company::where('email', $request->email)->first();

        if ($company && Hash::check($request->password, $company->password)) {
            // Login the company using the company guard
            Auth::guard('company')->login($company, $request->filled('remember'));

            // Redirect to company dashboard
            return redirect()->route('company.dashboard');
        }

        // If we reach here, authentication failed
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Log the user out of the application.
     * Override the default logout method to clear all guards and session data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Logout from both web and company guards
        Auth::guard('web')->logout();
        Auth::guard('company')->logout();

        // Invalidate the session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear any additional session data that might persist
        Session::flush();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
