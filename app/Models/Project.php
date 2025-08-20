<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'name', 'tagline', 'is_featured', 'description',
        'short_description', 'tech_stack', 'live_url', 'repo_url', 'details'
    ];

    // Add 'is_featured' to the casts array
    protected $casts = [
        'tech_stack' => 'array',
        'details' => 'array',
        'is_featured' => 'boolean' // <<< Add this line
    ];
}
