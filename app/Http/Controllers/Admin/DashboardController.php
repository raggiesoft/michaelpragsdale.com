<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Project;
use App\Models\Education;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the total counts for each content type.
        $jobCount = \App\Models\Job::count();
        $projectCount = \App\Models\Project::count();
        $educationCount = \App\Models\Education::count();

        // --- Data Integrity Checks ---
        // Find projects that are missing a detailed story.
        $projectsMissingDetails = \App\Models\Project::whereNull('details->story')->orWhere('details->story', '')->count();

        // Pass all the data to the dashboard view.
        return view('admin.dashboard', [
            'jobCount' => $jobCount,
            'projectCount' => $projectCount,
            'educationCount' => $educationCount,
            'projectsMissingDetails' => $projectsMissingDetails,
        ]);
    }
}
