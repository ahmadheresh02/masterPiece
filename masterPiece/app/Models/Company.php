<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory, SoftDeletes;

    protected $guard = 'company';

    protected $fillable = [
        'name',
        'email',
        'password',
        'description',
        'logo_url',
        'website_url',
        'industry',
        'company_size',
        'founded_year',
        'location',
        'is_verified'
    ];

    protected $hidden = [
        'password',
    ];

    public function listings()
    {
        return $this->hasMany(InternshipListing::class);
    }
}
