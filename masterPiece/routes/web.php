<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\InternshipListingController as AdminInternshipListingController;
use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/company-profile', function () {
    return view('CompanyProfile');
});

Route::get('/user-profile', function () {
    return view('UserProfile');
});

// Company routes
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');

Auth::routes(['register' => false]); // Disable default register route

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
