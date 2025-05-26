<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternshipListing extends Model
{
    /** @use HasFactory<\Database\Factories\InternshipListingFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'location',
        'duration',
        'requirements',
        'responsibilities',
        'application_deadline',
        'skills_required',
        'is_remote',
        'is_active',
        'is_paid',
        'company_id',
        'internship_type',
        'salary_range'
    ];

    protected $casts = [
        'is_remote' => 'boolean',
        'is_active' => 'boolean',
        'is_paid' => 'boolean',
        'skills_required' => 'array',
        'application_deadline' => 'date'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'listing_id');
    }
}
