<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Project;

class HomeComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Fetch only the projects that are marked as 'featured'.
        // We compare against the integer 1 for a more reliable query.
        $featuredProjects = Project::where('is_featured', 1)->latest()->get();

        // Pass the data directly to any view this composer is attached to.
        $view->with('featuredProjects', $featuredProjects);
    }
}
