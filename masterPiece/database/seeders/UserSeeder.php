<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create one admin user
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'university_name' => fake()->randomElement(['Hashemite University', 'University of Jordan']),
                'education_level' => 'Master\'s Degree',
                'major_field' => 'Computer Science',
                'graduation_year' => date('Y') - 3,
                'has_experience' => true,
                'skills' => ['Administration', 'Management', 'Communication'],
                'phone' => fake()->phoneNumber(),
                'profile_picture_url' => fake()->imageUrl(300, 300, 'people'),
                'headline' => 'System Administrator',
                'about' => fake()->paragraph(3),
                'location' => 'Amman, Jordan',
                'languages' => ['English', 'Arabic'],
                'is_admin' => true,
            ]
        );

        // Create 20 regular users
        User::factory()->count(20)->create();
    }
}
