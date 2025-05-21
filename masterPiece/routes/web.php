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

Route::get('/company-profile', function () {
    return view('CompanyProfile');
});

// Old static route, keeping for reference but can be removed
// Route::get('/user-profile', function () {
//     return view('UserProfile');
// });

// Company Dashboard Routes - Protected with auth middleware for both web and company guards
Route::middleware(['auth:web,company'])->group(function () {
    Route::get('/company-dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard');
    Route::get('/company/dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard');
});

Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');

// Internship Routes
Route::resource('internships', 'App\Http\Controllers\InternshipListingController');
Route::get('/internships/{internship}/applications', [App\Http\Controllers\ApplicationController::class, 'index'])->name('internships.applications.index');

// Application Routes
Route::get('/applications', [App\Http\Controllers\ApplicationController::class, 'userApplications'])->name('applications.index');
Route::resource('applications', 'App\Http\Controllers\ApplicationController')->except(['index']);
Route::post('/applications/{application}/status', [App\Http\Controllers\ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
Route::get('/internships/{internship}/apply', [App\Http\Controllers\ApplicationController::class, 'create'])->name('applications.create');
Route::post('/internships/{internship}/apply', [App\Http\Controllers\ApplicationController::class, 'store'])->name('applications.store');
Route::post('/internships/{internship}/quick-apply', [App\Http\Controllers\ApplicationController::class, 'quickApply'])->name('applications.quickApply');

// Resume Management Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/resume-management', [App\Http\Controllers\UserController::class, 'resumeManagement'])->name('resume.management');
    Route::post('/resume-upload', [App\Http\Controllers\UserController::class, 'uploadResume'])->name('resume.upload');
    Route::get('/resume-download', [App\Http\Controllers\UserController::class, 'downloadResume'])->name('resume.download');
    Route::delete('/resume-delete', [App\Http\Controllers\UserController::class, 'deleteResume'])->name('resume.delete');
});

Auth::routes(['register' => false]); // Disable default register route

// Registration type selection
Route::get('/register', function () {
    return view('auth.register-type-selection');
})->name('register');

// Multi-step Registration Routes
Route::get('/register/student', [App\Http\Controllers\Auth\RegisterController::class, 'showStep1'])->name('register.step1');
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

    // Internship Listings Management
    Route::get('/listings', [AdminInternshipListingController::class, 'index'])->name('listings.index');
    Route::get('/listings/{listing}', [AdminInternshipListingController::class, 'show'])->name('listings.show');
    Route::delete('/listings/{listing}', [AdminInternshipListingController::class, 'destroy'])->name('listings.destroy');

    // Applications Management
    Route::get('/applications', [AdminApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [AdminApplicationController::class, 'show'])->name('applications.show');
    Route::post('/applications/{application}/status', [AdminApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
    Route::delete('/applications/{application}', [AdminApplicationController::class, 'destroy'])->name('applications.destroy');
});
