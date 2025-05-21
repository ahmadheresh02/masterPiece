<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class CreateTestCompany extends Command
{
    protected $signature = 'company:create-test';
    protected $description = 'Create a test company account';

    public function handle()
    {
        $this->info('Creating a new test company account...');

        $email = $this->ask('Email address for the test company?', 'testcompany@example.com');
        $password = $this->secret('Password for the test company?') ?? 'password123';
        $name = $this->ask('Company name?', 'Test Company Inc.');

        // Check if company with this email already exists
        if (Company::where('email', $email)->exists()) {
            if ($this->confirm('A company with this email already exists. Do you want to delete it and create a new one?', true)) {
                Company::where('email', $email)->delete();
            } else {
                $this->error('Operation cancelled.');
                return 1;
            }
        }

        // Create the company
        $company = Company::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'description' => 'This is a test company created via console command.',
            'website_url' => 'https://example.com',
            'industry' => 'Technology',
            'company_size' => '1-10',
            'founded_year' => '2025',
            'location' => 'Test Location',
            'is_verified' => true,
        ]);

        $this->info('Test company created successfully!');
        $this->info('Email: ' . $email);
        $this->info('Password: ' . $password);
        $this->info('Name: ' . $name);

        return 0;
    }
}
