<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a list of all projects.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        // Pass a new, empty Project model to the view
        return view('admin.projects.create', ['project' => new Project()]);
    }

    /**
     * Store a newly created project in the database.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'details.story' => 'nullable|string',
            'details.features' => 'nullable|string',
            'tech_stack' => 'nullable|array',
            'live_url' => 'nullable|url',
            'repo_url' => 'nullable|url',
            'is_featured' => 'nullable',
        ]);

        // 2. Process the data
        $validatedData['is_featured'] = $request->has('is_featured');

        // Convert the multi-line features string into an array
        if (!empty($validatedData['details']['features'])) {
            $validatedData['details']['features'] = array_filter(array_map('trim', explode("\n", $validatedData['details']['features'])));
        }

        // Filter out any empty tech stack items
        if (!empty($validatedData['tech_stack'])) {
            $validatedData['tech_stack'] = array_filter($validatedData['tech_stack']);
        }

        // 3. Create the new project record
        Project::create($validatedData);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified project in the database.
     */
    public function update(Request $request, Project $project)
    {
        // 1. Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'details.story' => 'nullable|string',
            'details.features' => 'nullable|string',
            'tech_stack' => 'nullable|array',
            'live_url' => 'nullable|url',
            'repo_url' => 'nullable|url',
            'is_featured' => 'nullable',
        ]);

        // 2. Process the data
        $validatedData['is_featured'] = $request->has('is_featured');

        if (!empty($validatedData['details']['features'])) {
            $validatedData['details']['features'] = array_filter(array_map('trim', explode("\n", $validatedData['details']['features'])));
        }

        if (!empty($validatedData['tech_stack'])) {
            $validatedData['tech_stack'] = array_filter($validatedData['tech_stack']);
        } else {
            $validatedData['tech_stack'] = []; // Ensure it's an empty array if nothing is submitted
        }

        // 3. Update the project record
        $project->update($validatedData);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project from the database.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
