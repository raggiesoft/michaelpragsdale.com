<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Project;
use App\Models\Education;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Get the search query from the URL (e.g., the 'q' in ?q=laravel)
        $query = $request->input('q');

        // If the query is empty, just redirect back to the home page.
        if (empty($query)) {
            return redirect('/');
        }

        // --- THE DATABASE QUERY ---
        // Search across multiple columns in each of your tables.
        $jobs = Job::where('is_public', true)
                   ->where(function ($q) use ($query) {
                       $q->where('company', 'LIKE', "%{$query}%")
                         ->orWhere('roles', 'LIKE', "%{$query}%");
                   })->get();

        $projects = Project::where('name', 'LIKE', "%{$query}%")
                           ->orWhere('description', 'LIKE', "%{$query}%")
                           ->orWhere('short_description', 'LIKE', "%{$query}%")
                           ->orWhere('tech_stack', 'LIKE', "%{$query}%")
                           ->get();

        $education = Education::where('institution', 'LIKE', "%{$query}%")
                              ->orWhere('roles', 'LIKE', "%{$query}%")
                              ->get();

        // Send all the results to our new search results view.
        return view('pages.search-results', [
            'page_title' => 'Search Results for "' . $query . '"',
            'body_class' => 'page-search-results',
            'query'      => $query,
            'jobs'       => $jobs,
            'projects'   => $projects,
            'education'  => $education
        ]);
    }
}
