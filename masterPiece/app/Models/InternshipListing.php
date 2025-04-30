<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternshipListing extends Model
{
    /** @use HasFactory<\Database\Factories\InternshipListingFactory> */
    use HasFactory, SoftDeletes;

    protected $casts = [
        'is_remote' => 'boolean',
        'is_active' => 'boolean',
        'skills_required' => 'array',
        'application_deadline' => 'date'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
