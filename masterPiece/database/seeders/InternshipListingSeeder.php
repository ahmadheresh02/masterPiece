<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\InternshipListing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternshipListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all companies
        $companies = Company::all();

        // Skip if no companies exist
        if ($companies->isEmpty()) {
            return;
        }

        // Create 2-4 internship listings for each company
        $companies->each(function ($company) {
            // Check if the company already has listings
            $existingListingsCount = InternshipListing::where('company_id', $company->id)->count();

            // Only create new listings if the company has fewer than 2 listings
            if ($existingListingsCount < 2) {
                // Calculate how many listings to add to reach 2-4 total
                $listingsToAdd = rand(2, 4) - $existingListingsCount;

                if ($listingsToAdd > 0) {
                    InternshipListing::factory()
                        ->count($listingsToAdd)
                        ->create(['company_id' => $company->id]);
                }
            }
        });
    }
}
