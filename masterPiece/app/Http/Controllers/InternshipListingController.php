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
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user && $user->company) {
            $internships = InternshipListing::where('company_id', $user->company->id)
                ->withCount('applications')
                ->latest()
                ->paginate(10);

            return view('internships.index', compact('internships'));
        }

        // For regular users and guests, show all active internships
        $internships = InternshipListing::where('is_active', true)
            ->with('company')
            ->latest()
            ->paginate(12);

        return view('internships.browse', compact('internships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user->company) {
            return redirect()->route('home')->with('error', 'Only companies can create internship listings');
        }

        return view('internships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->company) {
            return redirect()->route('home')->with('error', 'Only companies can create internship listings');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'duration' => 'nullable|integer|min:1|max:24',
            'requirements' => 'nullable|string',
            'application_deadline' => 'required|date|after:today',
            'skills_required' => 'nullable|string',
            'is_remote' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Convert comma-separated skills to array
        if (!empty($validated['skills_required'])) {
            $validated['skills_required'] = array_map('trim', explode(',', $validated['skills_required']));
        } else {
            $validated['skills_required'] = [];
        }

        $internship = new InternshipListing($validated);
        $internship->company_id = $user->company->id;
        $internship->save();

        return redirect()->route('company.dashboard')
            ->with('success', 'Internship listing created successfully');
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

        // Check if user is the owner of this internship listing
        if (!$user->company || $user->company->id !== $internship->company_id) {
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

        // Check if user is the owner of this internship listing
        if (!$user->company || $user->company->id !== $internship->company_id) {
            return redirect()->route('home')->with('error', 'You are not authorized to edit this listing');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'duration' => 'nullable|integer|min:1|max:24',
            'requirements' => 'nullable|string',
            'application_deadline' => 'required|date',
            'skills_required' => 'nullable|string',
            'is_remote' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Convert comma-separated skills to array
        if (!empty($validated['skills_required'])) {
            $validated['skills_required'] = array_map('trim', explode(',', $validated['skills_required']));
        } else {
            $validated['skills_required'] = [];
        }

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

        // Check if user is the owner of this internship listing
        if (!$user->company || $user->company->id !== $internship->company_id) {
            return redirect()->route('home')->with('error', 'You are not authorized to delete this listing');
        }

        $internship->delete();

        return redirect()->route('company.dashboard')
            ->with('success', 'Internship listing deleted successfully');
    }
}
