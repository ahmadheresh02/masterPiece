<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyRegisterController extends Controller
{
    /**
     * Show the company registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.company-register');
    }

    /**
     * Handle a registration request for a company.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'description' => ['required', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'website_url' => ['required', 'url', 'max:255'],
            'industry' => ['required', 'string', 'max:255'],
            'company_size' => ['required', 'string', 'max:255'],
            'founded_year' => ['required', 'integer', 'min:1800', 'max:' . date('Y')],
            'location' => ['required', 'string', 'max:255'],
            'terms' => ['required', 'accepted'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('company.register')
                ->withErrors($validator)
                ->withInput();
        }

        // Handle logo upload
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('company-logos', 'public');
        }

        // Create the company
        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'description' => $request->description,
            'logo_url' => $logoPath ? Storage::url($logoPath) : null,
            'website_url' => $request->website_url,
            'industry' => $request->industry,
            'company_size' => $request->company_size,
            'founded_year' => $request->founded_year,
            'location' => $request->location,
            'is_verified' => false, // Companies start as unverified
        ]);

        // You might want to log the company in or redirect to a verification page
        // For now, let's redirect to the login page with a success message
        return redirect()->route('login')
            ->with('success', 'Your company has been registered successfully! Please log in.');
    }
}
