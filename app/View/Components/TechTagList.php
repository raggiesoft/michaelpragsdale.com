<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TechTagList extends Component
{
    public array $tagsToDisplay = [];

    // The component accepts an array of tag keys (e.g., ['php', 'scss'])
    public function __construct(public array $tags = [])
    {
        // Get the master list of all possible technologies from our config file.
        $allTechs = config('technologies');

        foreach ($this->tags as $tagKey) {
            // For each key we passed in, check if it exists in the master list.
            if (isset($allTechs[$tagKey])) {
                // If it exists, add it to the list to be displayed.
                $this->tagsToDisplay[] = [
                    'slug' => $tagKey,
                    'name' => $allTechs[$tagKey]
                ];
            }
        }
    }

    public function render(): View
    {
        return view('components.tech-tag-list');
    }
}
