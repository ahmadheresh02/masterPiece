<?php

// Bootstrap the Laravel application
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Company;
use Illuminate\Support\Facades\Hash;

// Set the test company details
$company = [
    'name' => 'Test Company Inc.',
    'email' => 'test@company.com',
    'password' => Hash::make('password123'),
    'description' => 'This is a test company.',
    'industry' => 'Technology',
    'company_size' => '1-10',
    'founded_year' => '2025',
    'location' => 'Amman, Jordan',
    'is_verified' => true,
    'website_url' => 'https://example.com',
];

// Check if company already exists
$existingCompany = Company::where('email', $company['email'])->first();
if ($existingCompany) {
    echo "Company with email {$company['email']} already exists. Deleting..." . PHP_EOL;
    $existingCompany->delete();
    echo "Deleted existing company." . PHP_EOL;
}

// Create the company
try {
    $newCompany = Company::create($company);
    echo "Successfully created test company:" . PHP_EOL;
    echo "Email: {$company['email']}" . PHP_EOL;
    echo "Password: password123" . PHP_EOL;
    echo "You can now log in with these credentials." . PHP_EOL;
} catch (Exception $e) {
    echo "Error creating company: " . $e->getMessage() . PHP_EOL;
}
