<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the user's profile
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.UserProfile', compact('user'));
    }

    /**
     * Show the form for editing the user's profile
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.EditProfile', compact('user'));
    }

    /**
     * Update the user's profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'headline' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'university_name' => 'nullable|string|max:255',
            'education_level' => 'nullable|string|max:255',
            'major_field' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|numeric|min:2000|max:2100',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'skills' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|max:2048',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Process skills and languages from comma-separated string to array
        if (isset($validated['skills']) && $validated['skills']) {
            $validated['skills'] = array_map('trim', explode(',', $validated['skills']));
        }
        
        if (isset($validated['languages']) && $validated['languages']) {
            $validated['languages'] = array_map('trim', explode(',', $validated['languages']));
        }

        // Handle profile picture upload if provided
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            $old_path = str_replace('/storage/', '', $user->profile_picture_url);
            if ($user->profile_picture_url && Storage::disk('public')->exists($old_path)) {
                Storage::disk('public')->delete($old_path);
            }

            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $validated['profile_picture_url'] = $path;
        }
        
        // Handle resume upload if provided
        if ($request->hasFile('resume')) {
            // Delete old resume if exists
            $old_resume_path = str_replace('/storage/', '', $user->default_resume_path);
            if ($user->default_resume_path && Storage::disk('public')->exists($old_resume_path)) {
                Storage::disk('public')->delete($old_resume_path);
            }

            $resumePath = $request->file('resume')->store('resumes', 'public');
            $validated['default_resume_path'] = Storage::url($resumePath);
        }

        $user->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}
