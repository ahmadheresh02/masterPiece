<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyDashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\InternshipListingController as AdminInternshipListingController;
use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// User Profile Routes
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Route for creating internships - available to anyone but will redirect to login if needed
// The controller's auth middleware will handle authentication internally
Route::get('/internships/create', [App\Http\Controllers\InternshipListingController::class, 'create'])->name('internships.create');
Route::post('/internships', [App\Http\Controllers\InternshipListingController::class, 'store'])->name('internships.store');

// Company Dashboard Routes - Protected with auth middleware for both web and company guards
Route::middleware(['auth:web,company', 'company.restrict'])->group(function () {
    // Route for companies awaiting approval
    Route::get('/company/awaiting-approval', function () {
        return view('company.awaiting-approval');
    })->name('company.awaiting-approval');

    // Routes that require company verification
    Route::middleware(['verified.company'])->group(function () {
        Route::get('/company-dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard');
        Route::get('/company/dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard');

        // Applicant profile view for companies
        Route::get('/applicants/{user}', [App\Http\Controllers\ProfileController::class, 'showForCompany'])->name('applicant.profile');

        // Company's additional internship management routes
        Route::get('/internships/{internship}/edit', [App\Http\Controllers\InternshipListingController::class, 'edit'])->name('internships.edit');
        Route::put('/internships/{internship}', [App\Http\Controllers\InternshipListingController::class, 'update'])->name('internships.update');
        Route::delete('/internships/{internship}', [App\Http\Controllers\InternshipListingController::class, 'destroy'])->name('internships.destroy');
        Route::get('/internships/{internship}/applications', [App\Http\Controllers\ApplicationController::class, 'index'])->name('internships.applications.index');
        Route::get('/applications/{application}', [App\Http\Controllers\ApplicationController::class, 'show'])->name('applications.show');
        Route::post('/applications/{application}/status', [App\Http\Controllers\ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
    });
});

// Public Routes
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');

// Public Internship Routes (view only)
Route::get('/internships', [App\Http\Controllers\InternshipListingController::class, 'index'])->name('internships.index');
Route::get('/internships/{internship}', [App\Http\Controllers\InternshipListingController::class, 'show'])->name('internships.show');

// Auth protected internship application routes (for regular users)
Route::middleware(['auth:web'])->group(function () {
    Route::get('/internships/{internship}/apply', [App\Http\Controllers\ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/internships/{internship}/apply', [App\Http\Controllers\ApplicationController::class, 'store'])->name('applications.store');
    Route::post('/internships/{internship}/quick-apply', [App\Http\Controllers\ApplicationController::class, 'quickApply'])->name('applications.quickApply');
    Route::get('/applications', [App\Http\Controllers\ApplicationController::class, 'userApplications'])->name('applications.index');
    Route::delete('/applications/{application}', [App\Http\Controllers\ApplicationController::class, 'destroy'])->name('applications.destroy');
});

// Resume Management Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/resume-management', [App\Http\Controllers\UserController::class, 'resumeManagement'])->name('resume.management');
    Route::post('/resume-upload', [App\Http\Controllers\UserController::class, 'uploadResume'])->name('resume.upload');
    Route::get('/resume-download', [App\Http\Controllers\UserController::class, 'downloadResume'])->name('resume.download');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Multiple-steps registration
Route::get('/register/step1', [App\Http\Controllers\Auth\RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [App\Http\Controllers\Auth\RegisterController::class, 'postStep1'])->name('register.step1.post');
Route::get('/register/step2', [App\Http\Controllers\Auth\RegisterController::class, 'showStep2'])->name('register.step2');
Route::post('/register/step2', [App\Http\Controllers\Auth\RegisterController::class, 'postStep2'])->name('register.step2.post');
Route::get('/register/step3', [App\Http\Controllers\Auth\RegisterController::class, 'showStep3'])->name('register.step3');
Route::post('/register/step3', [App\Http\Controllers\Auth\RegisterController::class, 'postStep3'])->name('register.step3.post');

// Company Registration Routes
Route::get('/company/register', [App\Http\Controllers\Auth\CompanyRegisterController::class, 'showRegistrationForm'])->name('company.register');
Route::post('/company/register', [App\Http\Controllers\Auth\CompanyRegisterController::class, 'register'])->name('company.register.post');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Users Management
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Companies Management
    Route::get('/companies', [AdminCompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/{company}', [AdminCompanyController::class, 'show'])->name('companies.show');
    Route::delete('/companies/{company}', [AdminCompanyController::class, 'destroy'])->name('companies.destroy');
    Route::post('/companies/{company}/verify', [AdminCompanyController::class, 'verify'])->name('companies.verify');
    Route::post('/companies/{company}/unverify', [AdminCompanyController::class, 'unverify'])->name('companies.unverify');

    // Internship Listings Management
    Route::get('/listings', [AdminInternshipListingController::class, 'index'])->name('listings.index');
    Route::get('/listings/{listing}', [AdminInternshipListingController::class, 'show'])->name('listings.show');
    Route::delete('/listings/{listing}', [AdminInternshipListingController::class, 'destroy'])->name('listings.destroy');

    // Applications Management
    Route::get('/applications', [AdminApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [AdminApplicationController::class, 'show'])->name('applications.show');
    Route::post('/applications/{application}/status', [AdminApplicationController::class, 'updateStatus'])
        ->name('applications.updateStatus'); // Within admin prefix, this becomes admin.applications.updateStatus
});

// Debug routes
Route::get('/debug/auth', [App\Http\Controllers\AuthDebugController::class, 'debug']);

// Static pages for testing
Route::get('/static/company-dashboard', function () {
    return view('static.company-dashboard');
})->name('static.company.dashboard');

// Route for testing with normal admin login (direct access to Dashboard)
Route::get('/debug/admin/login', function () {
    // Check if user exists first
    $user = App\Models\User::where('email', 'admin@example.com')->first();

    if (!$user) {
        // Create admin user if not exists
        $user = App\Models\User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);
    } elseif (!$user->is_admin) {
        // Make sure the user is an admin
        $user->update(['is_admin' => true]);
    }

    Auth::login($user);

    return redirect()->route('admin.dashboard');
});
