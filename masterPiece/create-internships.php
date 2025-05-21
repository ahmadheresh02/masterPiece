<?php

// Load the Laravel application
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Company;
use App\Models\InternshipListing;
use Illuminate\Support\Facades\DB;

// Check if companies exist
$companiesCount = Company::count();
if ($companiesCount == 0) {
    echo "No companies found. Creating sample companies first...\n";

    // Create sample companies if none exist
    Company::factory()->count(5)->create();
    echo "Created 5 sample companies.\n";
}

// Get all companies
$companies = Company::all();
echo "Found " . $companies->count() . " companies.\n";

// Create 3-5 internship listings for each company
$totalCreated = 0;
$companies->each(function ($company) use (&$totalCreated) {
    $count = rand(3, 5);
    echo "Creating {$count} internships for company: {$company->name}\n";

    InternshipListing::factory()
        ->count($count)
        ->create(['company_id' => $company->id]);

    $totalCreated += $count;
});

echo "Successfully created {$totalCreated} internship listings.\n";
echo "You can now refresh your internships page to see the data.\n";
