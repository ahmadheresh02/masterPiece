<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InternshipListing;
use App\Models\Application;

class InternshipListingController extends Controller
{
    public function index()
    {
        $listings = InternshipListing::with('company')
            ->withCount('applications')
            ->latest()
            ->paginate(10);

        return view('admin.listings.index', compact('listings'));
    }

    public function show(InternshipListing $listing)
    {
        $applications = Application::where('listing_id', $listing->id)
            ->with('user')
            ->latest()
            ->get();

        return view('admin.listings.show', compact('listing', 'applications'));
    }

    public function destroy(InternshipListing $listing)
    {
        try {
            $listing->delete();
            return redirect()->route('admin.listings.index')->with('success', 'Internship listing deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete listing. ' . $e->getMessage());
        }
    }
}
