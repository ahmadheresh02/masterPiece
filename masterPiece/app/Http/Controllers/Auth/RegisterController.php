<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the step 1 form for registration.
     *
     * @return \Illuminate\View\View
     */
    public function showStep1()
    {
        return view('auth.register', ['step' => 1]);
    }

    /**
     * Process the step 1 form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postStep1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('register.step1')
                ->withErrors($validator)
                ->withInput();
        }

        $request->session()->put('registration', [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('register.step2');
    }

    /**
     * Show the step 2 form for registration.
     *
     * @return \Illuminate\View\View
     */
    public function showStep2()
    {
        return view('auth.register', ['step' => 2]);
    }

    /**
     * Process the step 2 form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postStep2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'university_name' => ['nullable', 'string', 'max:255'],
            'education_level' => ['nullable', 'string', 'max:255'],
            'major_field' => ['nullable', 'string', 'max:255'],
            'graduation_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('register.step2')
                ->withErrors($validator)
                ->withInput();
        }

        $registration = $request->session()->get('registration', []);
        $registration = array_merge($registration, [
            'university_name' => $request->university_name,
            'education_level' => $request->education_level,
            'major_field' => $request->major_field,
            'graduation_year' => $request->graduation_year,
        ]);

        $request->session()->put('registration', $registration);

        return redirect()->route('register.step3');
    }

    /**
     * Show the step 3 form for registration.
     *
     * @return \Illuminate\View\View
     */
    public function showStep3()
    {
        return view('auth.register', ['step' => 3]);
    }

    /**
     * Process the step 3 form and complete registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postStep3(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'has_experience' => ['nullable', 'boolean'],
            'skills' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'headline' => ['nullable', 'string', 'max:255'],
            'about' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'languages' => ['nullable', 'string', 'max:255'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('register.step3')
                ->withErrors($validator)
                ->withInput();
        }

        $registration = $request->session()->get('registration', []);

        // Handle profile picture upload
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile-pictures', 'public');
        }

        // Create the user
        $user = User::create([
            'email' => $registration['email'],
            'password' => Hash::make($registration['password']),
            'first_name' => $registration['first_name'],
            'last_name' => $registration['last_name'],
            'university_name' => $registration['university_name'] ?? null,
            'education_level' => $registration['education_level'] ?? null,
            'major_field' => $registration['major_field'] ?? null,
            'graduation_year' => $registration['graduation_year'] ?? null,
            'has_experience' => $request->has('has_experience'),
            'skills' => $request->skills,
            'phone' => $request->phone,
            'profile_picture_url' => $profilePicturePath ? Storage::url($profilePicturePath) : null,
            'headline' => $request->headline,
            'about' => $request->about,
            'location' => $request->location,
            'languages' => $request->languages,
        ]);

        // Clear the registration session data
        $request->session()->forget('registration');

        // Log the user in
        auth()->login($user);

        return redirect('/')->with('success', 'Registration completed successfully!');
    }
}
