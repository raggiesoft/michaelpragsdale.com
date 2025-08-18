<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Http\Resources\EducationResource;

class EducationController extends Controller
{
    public function index()
    {
        $education = Education::latest()->get();
        return EducationResource::collection($education);
    }
}
