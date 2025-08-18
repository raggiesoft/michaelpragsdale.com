<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return ProjectResource::collection($projects);
    }
}
