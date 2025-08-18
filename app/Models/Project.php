<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
    'project_id', 'name', 'tagline', 'is_featured', 'description',
    'short_description', // <<< ADD THIS LINE
    'tech_stack', 'live_url', 'repo_url', 'details'
];

    protected $casts = ['tech_stack' => 'array', 'details' => 'array'];
}
