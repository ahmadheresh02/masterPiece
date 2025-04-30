<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// routes/web.php

// Multi-step Registration Routes
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [App\Http\Controllers\Auth\RegisterController::class, 'postStep1'])->name('register.step1.post');

Route::get('/register/step2', [App\Http\Controllers\Auth\RegisterController::class, 'showStep2'])->name('register.step2');
Route::post('/register/step2', [App\Http\Controllers\Auth\RegisterController::class, 'postStep2'])->name('register.step2.post');

Route::get('/register/step3', [App\Http\Controllers\Auth\RegisterController::class, 'showStep3'])->name('register.step3');
Route::post('/register/step3', [App\Http\Controllers\Auth\RegisterController::class, 'postStep3'])->name('register.step3.post');

// Company Registration Routes
Route::get('/company/register', [App\Http\Controllers\Auth\CompanyRegisterController::class, 'showRegistrationForm'])->name('company.register');
Route::post('/company/register', [App\Http\Controllers\Auth\CompanyRegisterController::class, 'register'])->name('company.register.post');
