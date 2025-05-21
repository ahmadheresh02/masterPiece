<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory, SoftDeletes, Notifiable;

    // Changed from 'company' to 'web' to match how LoginController is authenticating companies
    protected $guard = 'web';

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
        'remember_token',
    ];

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function listings()
    {
        return $this->hasMany(InternshipListing::class);
    }
}
