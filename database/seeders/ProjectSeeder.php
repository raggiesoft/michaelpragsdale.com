<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Facades\File;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear the table first to avoid duplicates on re-seeding
        Project::truncate();

        // Read the JSON file from the resources directory
        $json = File::get(resource_path('json/projects.json'));
        $projects = json_decode($json);

        foreach ($projects as $projectData) {
            Project::create([
                'id' => $projectData->id,
                'name' => $projectData->name,
                'tagline' => $projectData->tagline,
                'is_featured' => $projectData->is_featured,
                'short_description' => $projectData->short_description ?? null,
                'url' => $projectData->url ?? null,
                'repo_url' => $projectData->repo_url ?? null,
                'live_url' => $projectData->live_url ?? null,
                'details' => json_encode($projectData->details), // Store the details object as a JSON string
            ]);
        }
    }
}
