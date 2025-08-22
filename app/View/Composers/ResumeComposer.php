<?php

    namespace App\View\Composers;

    use App\Models\Project;
    use Illuminate\View\View;

    class ResumeComposer
    {
        /**
         * Bind data to the view.
         */
        public function compose(View $view): void
        {
            $view->with('featuredProjects', Project::where('is_featured', true)->take(3)->get());
        }
    }
