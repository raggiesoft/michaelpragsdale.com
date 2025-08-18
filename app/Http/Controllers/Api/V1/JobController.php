<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Http\Resources\JobResource;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('is_public', true)->latest()->get();
        return JobResource::collection($jobs);
    }
}
