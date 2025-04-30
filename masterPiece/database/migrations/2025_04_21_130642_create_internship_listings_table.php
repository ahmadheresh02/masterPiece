<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // database/migrations/[...]_create_internship_listings_table.php
            Schema::create('internship_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();

            // Listing Details
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->text('responsibilities')->nullable();
            $table->string('location');
            $table->boolean('is_remote')->default(false);
            $table->enum('internship_type', ['full-time', 'part-time', 'contract']);
            $table->string('duration');
            $table->string('salary_range')->nullable();
            $table->text('skills_required')->nullable();
            $table->date('application_deadline');
            $table->boolean('is_active')->default(true);

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('location');
            $table->index('is_remote');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_listings');
    }
};
