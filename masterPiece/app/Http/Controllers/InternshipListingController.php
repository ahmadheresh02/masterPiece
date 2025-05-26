<?php

namespace App\Http\Controllers;

use App\Models\InternshipListing;
use App\Http\Requests\StoreInternshipListingRequest;
use App\Http\Requests\UpdateInternshipListingRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InternshipListingController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Allow public access to browse and view individual listings
        // But require authentication for all other actions using either web or company guard
        $this->middleware('auth:web,company')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user && $user->company) {
            $internships = InternshipListing::where('company_id', $user->company->id)
                ->withCount('applications')
                ->latest()
                ->paginate(10);

            return view('internships.index', compact('internships'));
        }

        // For regular users and guests, show all active internships with filtering
        $query = InternshipListing::where('is_active', true)->with('company');

        // Apply search filters if provided
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('requirements', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('company', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', '%' . $keyword . '%');
                    });
            });
        }

        if ($request->filled('industry')) {
            $industry = $request->input('industry');
            $query->whereHas('company', function ($q) use ($industry) {
                $q->where('industry', 'LIKE', '%' . $industry . '%');
            });
        }

        if ($request->filled('location')) {
            $location = $request->input('location');
            if ($location === 'remote') {
                $query->where('is_remote', true);
            } else {
                $query->where('location', 'LIKE', '%' . $location . '%');
            }
        }

        // Advanced filters
        if ($request->filled('duration')) {
            $duration = $request->input('duration');
            switch ($duration) {
                case 'summer':
                    $query->whereBetween('duration', [2, 3]);
                    break;
                case 'semester':
                    $query->whereBetween('duration', [3, 4]);
                    break;
                case 'sixmonths':
                    $query->where('duration', 6);
                    break;
                case 'year':
                    $query->where('duration', 12);
                    break;
            }
        }

        if ($request->has('paid')) {
            $query->where('is_paid', true);
        }

        if ($request->has('unpaid')) {
            $query->where('is_paid', false);
        }

        // Get the filtered results
        $internships = $query->latest()->paginate(12);

        // Pass search parameters back to the view for maintaining filters
        return view('internships.browse', compact('internships'))
            ->with('searchParams', $request->only([
                'keyword',
                'industry',
                'location',
                'duration',
                'paid',
                'unpaid',
                'credit',
                'start_date'
            ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        // Check if there's a company associated with the user
        // or if the user is logged in through the company guard
        if ((!$user || !$user->company) && !Auth::guard('company')->check()) {
            return redirect()->route('home')->with('error', 'Only companies can create internship listings');
        }

        // Get the company either from the user relation or directly from the company guard
        $company = $user && $user->company ? $user->company : Auth::guard('company')->user();

        return view('internships.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $companyUser = Auth::guard('company')->user();

        // Get company either from user relation or company guard
        $company = null;
        if ($user && $user->company) {
            $company = $user->company;
        } elseif ($companyUser) {
            $company = $companyUser;
        }

        if (!$company) {
            return redirect()->route('home')->with('error', 'Only companies can create internship listings');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'duration' => 'required|integer|min:1|max:24',
            'requirements' => 'required|string',
            'responsibilities' => 'nullable|string',
            'application_deadline' => 'required|date|after:today',
            'skills_required' => 'nullable|string',
            'salary_range' => 'nullable|string|max:255',
            'internship_type' => 'required|in:full-time,part-time,contract',
            'is_remote' => 'boolean',
            'is_active' => 'boolean',
            'is_paid' => 'boolean',
        ]);

        // Convert comma-separated skills to array
        if (!empty($validated['skills_required'])) {
            $validated['skills_required'] = array_map('trim', explode(',', $validated['skills_required']));
        } else {
            $validated['skills_required'] = [];
        }

        // Set boolean fields that might not be present in the request
        $validated['is_remote'] = $request->has('is_remote');
        $validated['is_active'] = $request->has('is_active');

        $internship = new InternshipListing($validated);
        $internship->company_id = $company->id;
        $internship->save();

        return redirect()->route('company.dashboard')
            ->with('success', 'Internship listing created successfully. It is now available for students to apply.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InternshipListing $internship)
    {
        $internship->load('company');

        return view('internships.show', compact('internship'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InternshipListing $internship)
    {
        $user = Auth::user();
        $companyUser = Auth::guard('company')->user();

        // Get company either from user relation or company guard
        $company = null;
        if ($user && $user->company) {
            $company = $user->company;
        } elseif ($companyUser) {
            $company = $companyUser;
        }

        // Check if user is the owner of this internship listing
        if (!$company || $company->id !== $internship->company_id) {
            return redirect()->route('home')->with('error', 'You are not authorized to edit this listing');
        }

        return view('internships.edit', compact('internship'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InternshipListing $internship)
    {
        $user = Auth::user();
        $companyUser = Auth::guard('company')->user();

        // Get company either from user relation or company guard
        $company = null;
        if ($user && $user->company) {
            $company = $user->company;
        } elseif ($companyUser) {
            $company = $companyUser;
        }

        // Check if user is the owner of this internship listing
        if (!$company || $company->id !== $internship->company_id) {
            return redirect()->route('home')->with('error', 'You are not authorized to edit this listing');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'duration' => 'required|integer|min:1|max:24',
            'requirements' => 'required|string',
            'responsibilities' => 'nullable|string',
            'application_deadline' => 'required|date',
            'skills_required' => 'nullable|string',
            'salary_range' => 'nullable|string|max:255',
            'internship_type' => 'required|in:full-time,part-time,contract',
            'is_remote' => 'boolean',
            'is_active' => 'boolean',
            'is_paid' => 'boolean',
        ]);

        // Convert comma-separated skills to array
        if (!empty($validated['skills_required'])) {
            $validated['skills_required'] = array_map('trim', explode(',', $validated['skills_required']));
        } else {
            $validated['skills_required'] = [];
        }

        // Set boolean fields that might not be present in the request
        $validated['is_remote'] = $request->has('is_remote');
        $validated['is_active'] = $request->has('is_active');

        $internship->update($validated);

        return redirect()->route('company.dashboard')
            ->with('success', 'Internship listing updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternshipListing $internship)
    {
        $user = Auth::user();
        $companyUser = Auth::guard('company')->user();

        // Get company either from user relation or company guard
        $company = null;
        if ($user && $user->company) {
            $company = $user->company;
        } elseif ($companyUser) {
            $company = $companyUser;
        }

        // Check if user is the owner of this internship listing
        if (!$company || $company->id !== $internship->company_id) {
            return redirect()->route('home')->with('error', 'You are not authorized to delete this listing');
        }

        $internship->delete();

        return redirect()->route('company.dashboard')
            ->with('success', 'Internship listing deleted successfully');
    }

    /**
     * Apply directly to an internship without redirects.
     */
    public function applyDirect(InternshipListing $internship)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to apply for internships');
        }

        // Check if user is a company (companies can't apply)
        if ($user->company) {
            return back()->with('error', 'Companies cannot apply for internships');
        }

        // Check if the listing is active
        if (!$internship->is_active) {
            return back()->with('error', 'This internship listing is no longer active');
        }

        // Check if the user already applied - show clear error message
        $existingApplication = \App\Models\Application::where([
            'user_id' => $user->id,
            'listing_id' => (int) $internship->id
        ])->first();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied for this internship. You can track your application status in your applications dashboard.');
        }

        try {
            // Create a basic application without requiring a resume or cover letter
            $application = new \App\Models\Application();
            $application->user_id = $user->id;
            $application->listing_id = (int) $internship->id;
            $application->status = 'pending';
            $application->cover_letter = 'Applied directly from internship listing page.';

            // Use a default resume path for simplicity
            $application->resume_path = $user->default_resume_path ?? 'resumes/default-resume.pdf';

            $application->save();

            return redirect()->route('applications.index')
                ->with('success', 'Your application has been submitted successfully! You can see it in your applications list.');

        } catch (\Exception $e) {
            \Log::error('Direct application error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred. Please try again later.');
        }
    }
}
