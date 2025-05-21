<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'listing_id',
        'status',
        'cover_letter',
        'resume_path'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Renamed relationship to match how it's being used throughout the app
    public function internshipListing()
    {
        return $this->belongsTo(InternshipListing::class, 'listing_id');
    }

    // Keep the old relationship method for backward compatibility
    public function listing()
    {
        return $this->belongsTo(InternshipListing::class, 'listing_id');
    }
}
