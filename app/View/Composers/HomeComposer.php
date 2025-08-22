<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class HomeComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        // Read project data from the JSON file
        $projects = json_decode(File::get(resource_path('json/projects.json')), true);

        // Filter for featured projects and pass it to the view as a Collection
        $view->with('featuredProjects', collect($projects)->where('is_featured', true)->take(2));
    }
}
