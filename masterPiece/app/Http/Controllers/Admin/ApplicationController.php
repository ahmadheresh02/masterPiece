<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['user', 'internshipListing.company'])
            ->latest()
            ->paginate(10);

        return view('admin.applications.index', compact('applications'));
    }

    public function show(Application $application)
    {
        $application->load(['user', 'internshipListing.company']);
        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewing,interviewed,accepted,rejected',
        ]);

        try {
            $application->update([
                'status' => $validated['status'],
            ]);

            return back()->with('success', 'Application status updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update application status. ' . $e->getMessage());
        }
    }

    public function destroy(Application $application)
    {
        try {
            $application->delete();
            return redirect()->route('admin.applications.index')->with('success', 'Application deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete application. ' . $e->getMessage());
        }
    }
}
