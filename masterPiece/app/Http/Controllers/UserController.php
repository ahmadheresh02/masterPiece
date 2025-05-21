<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Show the resume management page for the authenticated user.
     */
    public function resumeManagement()
    {
        $user = Auth::user();
        return view('users.resume', compact('user'));
    }

    /**
     * Upload a resume for the authenticated user.
     */
    public function uploadResume(Request $request)
    {
        $validated = $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $user = Auth::user();

        // Delete old resume if it exists
        if ($user->default_resume_path && Storage::disk('public')->exists($user->default_resume_path)) {
            Storage::disk('public')->delete($user->default_resume_path);
        }

        // Upload new resume
        $resumePath = $request->file('resume')->store('resumes/users', 'public');
        $resumeName = $request->file('resume')->getClientOriginalName();

        $user->default_resume_path = $resumePath;
        $user->save();

        return redirect()->route('resume.management')->with('success', 'Resume uploaded successfully.');
    }

    /**
     * Download the authenticated user's resume.
     */
    public function downloadResume()
    {
        $user = Auth::user();

        if (!$user->default_resume_path || !Storage::disk('public')->exists($user->default_resume_path)) {
            return redirect()->route('resume.management')->with('error', 'No resume found.');
        }

        return Storage::disk('public')->download($user->default_resume_path, 'resume-' . $user->first_name . '-' . $user->last_name . '.' . pathinfo($user->default_resume_path, PATHINFO_EXTENSION));
    }

    /**
     * Delete the authenticated user's resume.
     */
    public function deleteResume()
    {
        $user = Auth::user();

        if ($user->default_resume_path && Storage::disk('public')->exists($user->default_resume_path)) {
            Storage::disk('public')->delete($user->default_resume_path);

            $user->default_resume_path = null;
            $user->save();

            return redirect()->route('resume.management')->with('success', 'Resume deleted successfully.');
        }

        return redirect()->route('resume.management')->with('error', 'No resume found.');
    }
}
