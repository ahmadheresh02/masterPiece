<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InternshipListing>
 */
class InternshipListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $internshipTypes = ['full-time', 'part-time', 'contract'];
        $durations = ['3 months', '4 months', '6 months', 'Summer', 'Fall semester', 'Spring semester'];
        $salaryRanges = ['Unpaid', '$500-$1000/month', '$1000-$1500/month', '$1500-$2000/month', 'Competitive'];
        $skills = [
            'JavaScript',
            'Python',
            'Java',
            'HTML/CSS',
            'SQL',
            'React',
            'Node.js',
            'Project Management',
            'Data Analysis',
            'UX/UI Design',
            'Marketing',
            'Communication'
        ];

        return [
            'company_id' => Company::factory(),
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraphs(3, true),
            'requirements' => $this->faker->paragraphs(2, true),
            'responsibilities' => $this->faker->paragraphs(2, true),
            'location' => $this->faker->city() . ', ' . $this->faker->country(),
            'is_remote' => $this->faker->boolean(30), // 30% chance of being remote
            'internship_type' => $this->faker->randomElement($internshipTypes),
            'duration' => $this->faker->randomElement($durations),
            'salary_range' => $this->faker->randomElement($salaryRanges),
            'skills_required' => $this->faker->randomElements($skills, $this->faker->numberBetween(3, 6)),
            'application_deadline' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
        ];
    }
}
