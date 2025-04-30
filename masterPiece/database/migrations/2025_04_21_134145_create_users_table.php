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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            // Profile
            $table->string('first_name');
            $table->string('last_name');
            $table->string('university_name')->nullable();
            $table->string('education_level')->nullable();
            $table->string('major_field')->nullable();
            $table->integer('graduation_year')->nullable();
            $table->boolean('has_experience')->default(false);
            $table->text('skills')->nullable();

            // Contact
            $table->string('phone')->nullable();
            $table->string('profile_picture_url')->nullable();
            $table->string('headline')->nullable();
            $table->text('about')->nullable();
            $table->string('location')->nullable();
            $table->text('languages')->nullable();

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('university_name');
            $table->index('has_experience');
        });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
