<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Job;
use App\Models\Education;
use App\Models\Project;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data to prevent duplicates when re-seeding.
        Job::truncate();
        Education::truncate();
        Project::truncate();

        // --- Seed Jobs ---
        $jobs_json = File::get(public_path('assets/json/employment.json'));
        $jobsData = json_decode($jobs_json, true);
        foreach ($jobsData as $jobData) {
            $job = new Job();
            $job->company = $jobData['company'];
            $job->location = $jobData['location'];
            $job->period = $jobData['period'];
            $job->logo = $jobData['logo'] ?? null;
            $job->categories = $jobData['categories'] ?? null;
            $job->is_public = $jobData['is_public'] ?? false;
            $job->notes = $jobData['notes'] ?? null;
            $job->roles = $jobData['roles']; // Eloquent will handle encoding this array
            $job->save();
        }

        // --- Seed Education ---
        $edu_json = File::get(public_path('assets/json/education.json'));
        $educationData = json_decode($edu_json, true);
        foreach ($educationData as $edu_item) {
            $education = new Education();
            $education->institution = $edu_item['institution'];
            $education->location = $edu_item['location'];
            $education->period = $edu_item['period'];
            $education->logo = $edu_item['logo'] ?? null;
            $education->categories = $edu_item['categories'] ?? null;
            $education->roles = $edu_item['roles'];
            $education->save();
        }

        // --- Seed Projects ---
        $projects_json = File::get(public_path('assets/json/projects.json'));
        $projectsData = json_decode($projects_json, true);
        foreach ($projectsData as $projectData) {
            $project = new Project();
            $project->project_id = $projectData['id'];
            $project->name = $projectData['name'];
            $project->tagline = $projectData['tagline'];
            $project->is_featured = $projectData['is_featured'] ?? false;
            $project->description = $projectData['description'] ?? null;
            $project->short_description = $projectData['short_description'] ?? null;
            $project->tech_stack = $projectData['tech_stack'];
            $project->live_url = $projectData['live_url'] ?? null;
            $project->repo_url = $projectData['repo_url'] ?? null;
            $project->details = $projectData['details'] ?? null;
            $project->save();
        }
    }
}
