<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Company;
use Illuminate\Support\Facades\Hash;

// Test company details
$email = 'testcompany@example.com';
$password = 'password123';
$name = 'Test Company Inc.';

echo "Creating test company...\n";

// Check if a company with this email already exists
if (Company::where('email', $email)->exists()) {
    echo "A company with email {$email} already exists. Deleting it...\n";
    Company::where('email', $email)->delete();
}

// Create a new company
$company = Company::create([
    'name' => $name,
    'email' => $email,
    'password' => Hash::make($password),
    'description' => 'This is a test company created via script.',
    'website_url' => 'https://example.com',
    'industry' => 'Technology',
    'company_size' => '1-10',
    'founded_year' => '2025',
    'location' => 'Test Location',
    'is_verified' => true,
]);

echo "Test company created successfully!\n";
echo "Email: {$email}\n";
echo "Password: {$password}\n";
echo "Name: {$name}\n";

echo "You can now log in with these credentials at " . url('/login') . "\n";
