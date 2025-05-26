<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\InternshipListing;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Apply auth middleware to all methods except those specified
        $this->middleware('auth:web,company');
    }

    /**
     * Display a listing of the user's applications.
     */
    public function userApplications()
    {
        $user = Auth::user();

        // For regular users, show their applications
        if (!$user->company) {
            $applications = $user->applications()
                ->with(['internshipListing', 'internshipListing.company'])
                ->latest()
                ->paginate(10);

            return view('applications.user-applications', compact('applications'));
        }

        // For companies, show applications to their listings
        $applications = Application::whereHas('internshipListing', function ($query) use ($user) {
            $query->where('company_id', $user->company->id);
        })
            ->with(['user', 'internshipListing'])
            ->latest()
            ->paginate(10);

        return view('applications.company-applications', compact('applications'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(InternshipListing $internship)
    {
        $user = Auth::user();

        // Check if user is the owner of this internship listing
        if (!$user->company || $user->company->id !== $internship->company_id) {
            return redirect()->route('home')->with('error', 'You are not authorized to view these applications');
        }

        $applications = $internship->applications()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('applications.index', compact('internship', 'applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $internshipId = null)
    {
        // If internship is passed through route model binding
        if ($internshipId === null && $request->route('internship')) {
            $internship = $request->route('internship');
        } else {
            // Make sure internshipId is a valid integer
            $internshipId = is_numeric($internshipId) ? (int) $internshipId : null;

            // Or if it's in the request
            if ($internshipId === null && $request->has('internship')) {
                $internshipId = is_numeric($request->internship) ? (int) $request->internship : null;
            }

            if ($internshipId === null) {
                return redirect()->route('internships.index')
                    ->with('error', 'Invalid internship selected. Please try again.');
            }

            $internship = InternshipListing::findOrFail($internshipId);
        }

        $user = Auth::user();

        // Check if the user is not a company
        if ($user->company) {
            return redirect()->route('home')->with('error', 'Companies cannot apply for internships');
        }

        // Check if the listing is active
        if (!$internship->is_active) {
            return redirect()->route('home')->with('error', 'This internship listing is no longer active');
        }

        // Check if the user has already applied
        $existingApplication = Application::where('user_id', $user->id)
            ->where('listing_id', $internship->id)
            ->first();

        if ($existingApplication) {
            return redirect()->route('home')->with('error', 'You have already applied for this internship. You can track your application status in your applications dashboard.');
        }

        return view('applications.create', compact('internship'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, InternshipListing $internship)
    {
        $user = Auth::user();

        // Check if the user is not a company
        if ($user->company) {
            return redirect()->route('home')->with('error', 'Companies cannot apply for internships');
        }

        // Check if the listing is active
        if (!$internship->is_active) {
            return redirect()->route('home')->with('error', 'This internship listing is no longer active');
        }

        // Check if the user has already applied
        $existingApplication = Application::where('user_id', $user->id)
            ->where('listing_id', $internship->id)
            ->first();

        if ($existingApplication) {
            return redirect()->route('home')->with('error', 'You have already applied for this internship. You can track your application status in your applications dashboard.');
        }

        $validated = $request->validate([
            'cover_letter' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048', // Changed from nullable to required
        ]);

        // Handle resume upload
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        } else {
            return redirect()->back()->with('error', 'A resume is required to apply for this internship.');
        }

        try {
            $application = new Application([
                'user_id' => $user->id,
                'listing_id' => $internship->id,
                'cover_letter' => $validated['cover_letter'],
                'resume_path' => $resumePath,
                'status' => 'pending',
            ]);

            $application->save();

            return redirect()->route('home')->with('success', 'Your application has been submitted successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Application submission error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while submitting your application. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        $user = Auth::user();

        // Check if user is authorized to view this application
        $isCompanyOwner = false;

        try {
            // Add null checks to prevent 'Attempt to read property id on null'
            if (
                $user->company &&
                $application->internshipListing &&
                $application->internshipListing->company_id
            ) {
                $isCompanyOwner = $user->company->id === $application->internshipListing->company_id;
            }

            $isApplicant = $user->id === $application->user_id;

            if (!$isCompanyOwner && !$isApplicant) {
                return redirect()->route('profile.show')->with('error', 'You are not authorized to view this application');
            }

            $application->load(['user', 'internshipListing.company']);

            return view('applications.show', compact('application'));

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Application view error: ' . $e->getMessage());
            // Redirect to profile page with error message
            return redirect()->route('profile.show')->with('error', 'Unable to view this application');
        }
    }

    /**
     * Update the status of an application.
     */
    public function updateStatus(Request $request, Application $application)
    {
        try {
            // Get user from appropriate guard
            $user = null;
            $company = null;

            if (Auth::guard('web')->check()) {
                $user = Auth::guard('web')->user();
                if ($user->company) {
                    $company = $user->company;
                }
            } elseif (Auth::guard('company')->check()) {
                $company = Auth::guard('company')->user();
            }

            // Check company authorization
            if (
                !$company ||
                !$application->internshipListing ||
                $application->internshipListing->company_id != $company->id
            ) {
                return redirect()->route('home')->with('error', 'You are not authorized to update this application');
            }

            $validated = $request->validate([
                'status' => 'required|in:pending,under_review,shortlisted,rejected,accepted',
                'feedback' => 'nullable|string',
            ]);

            $application->status = $validated['status'];

            if (isset($validated['feedback'])) {
                $application->feedback = $validated['feedback'];
            }

            $application->save();

            return redirect()->back()->with('success', 'Application status updated successfully');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Application status update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to update application status: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        $user = Auth::user();

        try {
            // Check if user is authorized to delete this application
            $isCompanyOwner = false;

            // Add null checks to prevent 'Attempt to read property id on null'
            if (
                $user->company &&
                $application->internshipListing &&
                $application->internshipListing->company_id
            ) {
                $isCompanyOwner = $user->company->id === $application->internshipListing->company_id;
            }

            $isApplicant = $user->id === $application->user_id;

            if (!$isCompanyOwner && !$isApplicant) {
                return redirect()->route('home')->with('error', 'You are not authorized to delete this application');
            }

            $application->delete();

            return redirect()->back()->with('success', 'Application deleted successfully');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Application deletion error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to delete application');
        }
    }

    /**
     * Handle a quick application submission from the browse page.
     */
    public function quickApply(Request $request, $internshipId)
    {
        $user = Auth::user();
        $internship = InternshipListing::findOrFail($internshipId);

        // Check if the user is not a company
        if ($user->company) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Companies cannot apply for internships'], 403);
            }
            return redirect()->back()->with('error', 'Companies cannot apply for internships');
        }

        // Check if the listing is active
        if (!$internship->is_active) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'This internship listing is no longer active'], 400);
            }
            return redirect()->back()->with('error', 'This internship listing is no longer active');
        }

        // Check if the user has already applied
        $existingApplication = Application::where('user_id', $user->id)
            ->where('listing_id', $internship->id)
            ->first();

        if ($existingApplication) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already applied for this internship. You can track your application status in your applications dashboard.'
                ], 400);
            }
            return redirect()->back()->with('error', 'You have already applied for this internship. You can track your application status in your applications dashboard.');
        }

        try {
            // Create a basic application without resume
            $application = new Application([
                'user_id' => $user->id,
                'listing_id' => $internship->id,
                'cover_letter' => 'Quick application submitted from browse page.',
                'status' => 'pending',
                // Use user's default resume if available, otherwise leave null
                'resume_path' => $user->default_resume_path ?? null,
            ]);

            $application->save();

            // Return JSON response for AJAX requests
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your application has been submitted successfully!',
                    'application' => $application
                ]);
            }

            return redirect()->route('applications.index')->with('success', 'Your application has been submitted successfully! You can update it with more details from your dashboard.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Quick application submission error: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
            }

            return redirect()->back()->with('error', 'An error occurred while submitting your application. Please try again later.');
        }
    }
}
