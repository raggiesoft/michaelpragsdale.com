<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', ['projects' => $projects]);
    }

    public function create()
    {
        return view('admin.projects.create', ['project' => new Project()]);
    }

    public function store(Request $request)
    {
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

        $validatedData['is_featured'] = $request->has('is_featured');

        if (!empty($validatedData['details']['features'])) {
            $validatedData['details']['features'] = array_filter(array_map('trim', explode("\n", $validatedData['details']['features'])));
        }

        if (!empty($validatedData['tech_stack'])) {
            $validatedData['tech_stack'] = array_filter($validatedData['tech_stack']);
        }

        Project::create($validatedData);
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', ['project' => $project]);
    }

    public function update(Request $request, Project $project)
    {
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

        $validatedData['is_featured'] = $request->has('is_featured');

        if (!empty($validatedData['details']['features'])) {
            $validatedData['details']['features'] = array_filter(array_map('trim', explode("\n", $validatedData['details']['features'])));
        }

        if (!empty($validatedData['tech_stack'])) {
            $validatedData['tech_stack'] = array_filter($validatedData['tech_stack']);
        } else {
            $validatedData['tech_stack'] = [];
        }

        $project->update($validatedData);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
