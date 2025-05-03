<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $industries = ['Technology', 'Finance', 'Healthcare', 'Education', 'Manufacturing', 'Retail', 'Media', 'Consulting', 'Energy', 'Transportation'];
        $companySizes = ['1-10', '11-50', '51-200', '201-500', '501-1000', '1000+'];

        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail(),
            'password' => Hash::make('password'),
            'description' => $this->faker->paragraph(3),
            'logo_url' => $this->faker->imageUrl(200, 200, 'business'),
            'website_url' => $this->faker->url(),
            'industry' => $this->faker->randomElement($industries),
            'company_size' => $this->faker->randomElement($companySizes),
            'founded_year' => $this->faker->numberBetween(1950, 2024),
            'location' => $this->faker->city() . ', ' . $this->faker->country(),
            'is_verified' => $this->faker->boolean(70), // 70% chance of being verified
        ];
    }
}
