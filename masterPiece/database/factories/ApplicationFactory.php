<?php

namespace Database\Factories;

use App\Models\InternshipListing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['pending', 'reviewed', 'interview', 'accepted', 'rejected'];

        return [
            'listing_id' => InternshipListing::factory(),
            'user_id' => User::factory(),
            'resume_path' => 'resumes/' . $this->faker->uuid() . '.pdf',
            'cover_letter' => $this->faker->boolean(70) ? $this->faker->paragraphs(2, true) : null,
            'status' => $this->faker->randomElement($statuses),
        ];
    }
}
