<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        return view('pages.projects', [
            'projects' => Project::all(),
            'sidebar' => 'sidebars._sidebar-projects'
        ]);
    }

    /**
     * Display the specified project.
     */
    public function show(string $id)
    {
        $project = Project::findOrFail($id);

        return view('pages.projects.detail', [
            'project' => $project,
            'sidebar' => 'sidebars._sidebar-project-detail'
        ]);
    }
}
