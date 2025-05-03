<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $educationLevels = ['High School', 'Associate Degree', 'Bachelor\'s Degree', 'Master\'s Degree', 'PhD'];
        $majors = [
            'Computer Science',
            'Business Administration',
            'Engineering',
            'Marketing',
            'Finance',
            'Psychology',
            'Biology',
            'Mathematics',
            'Communications',
            'Nursing'
        ];
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
            'Communication',
            'Problem Solving'
        ];
        $languages = ['English', 'Arabic', 'Spanish', 'French', 'German', 'Chinese', 'Japanese'];

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'university_name' => $this->faker->randomElement(['Hashemite University', 'University of Jordan', 'PSUT', 'JUST', 'Yarmouk University']),
            'education_level' => $this->faker->randomElement($educationLevels),
            'major_field' => $this->faker->randomElement($majors),
            'graduation_year' => $this->faker->numberBetween(date('Y'), date('Y') + 4),
            'has_experience' => $this->faker->boolean(40), // 40% chance of having experience
            'skills' => $this->faker->randomElements($skills, $this->faker->numberBetween(3, 6)),
            'phone' => $this->faker->phoneNumber(),
            'profile_picture_url' => $this->faker->imageUrl(300, 300, 'people'),
            'headline' => $this->faker->sentence(6),
            'about' => $this->faker->paragraph(3),
            'location' => $this->faker->city() . ', ' . $this->faker->country(),
            'languages' => $this->faker->randomElements($languages, $this->faker->numberBetween(1, 3)),
            'is_admin' => false,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user is an admin.
     */
    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_admin' => true,
        ]);
    }
}
