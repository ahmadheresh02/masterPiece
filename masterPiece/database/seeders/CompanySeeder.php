<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create one demo company with fixed credentials for testing
        Company::firstOrCreate(
            ['email' => 'company@example.com'],
            [
                'name' => 'Demo Company',
                'password' => Hash::make('password'),
                'is_verified' => true,
                'description' => fake()->paragraph(3),
                'logo_url' => fake()->imageUrl(200, 200, 'business'),
                'website_url' => fake()->url(),
                'industry' => fake()->randomElement(['Technology', 'Finance', 'Healthcare', 'Education']),
                'company_size' => fake()->randomElement(['1-10', '11-50', '51-200', '201-500']),
                'founded_year' => fake()->numberBetween(1950, 2024),
                'location' => fake()->city() . ', ' . fake()->country(),
            ]
        );

        // Create 9 more random companies
        Company::factory()->count(9)->create();
    }
}
