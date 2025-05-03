<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\InternshipListing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users and listings
        $users = User::where('is_admin', false)->get();
        $listings = InternshipListing::all();

        // Skip if no users or listings exist
        if ($users->isEmpty() || $listings->isEmpty()) {
            return;
        }

        // For each user, apply to 1-3 random internship listings
        foreach ($users as $user) {
            // Get a random number of listings (1-3)
            $applicationsCount = rand(1, min(3, $listings->count()));

            // Get random listings
            $randomListings = $listings->random(min($applicationsCount, $listings->count()));

            foreach ($randomListings as $listing) {
                // Check if this application already exists
                $exists = Application::where('user_id', $user->id)
                    ->where('listing_id', $listing->id)
                    ->exists();

                if (!$exists) {
                    Application::factory()->create([
                        'user_id' => $user->id,
                        'listing_id' => $listing->id
                    ]);
                }
            }
        }
    }
}
