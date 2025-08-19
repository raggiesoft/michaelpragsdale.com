<?php

namespace App\View\Composers;

use Illuminate\View\View;

class NavigationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Get all the data that was passed from the route to the view.
        $viewData = $view->getData();
        // Get the array of nav blocks requested by the route, defaulting to the main menu.
        $requestedBlocks = $viewData['nav_blocks'] ?? ['default_menu'];

        // Get the master list of all available navigation blocks.
        $masterNavRegistry = $this->getMasterNavRegistry();

        $navigationBlocks = [];

        // Loop through the requested blocks and build the final array of nav data.
        foreach ($requestedBlocks as $blockName) {
            if (isset($masterNavRegistry[$blockName])) {
                $navigationBlocks[] = $masterNavRegistry[$blockName];
            }
        }

        // Pass the final array of blocks to the view.
        $view->with('navigationBlocks', $navigationBlocks);
    }

    /**
     * A private helper function to hold the master list of all navigation elements.
     * This is our central "registry" for menus and button groups.
     */
    private function getMasterNavRegistry(): array
    {
        return [
            'default_menu' => [
                'type' => 'menu',
                'items' => [
                    '/' => ['text' => 'Home', 'icon' => 'house'],
                    '/resume' => ['text' => 'Résumé', 'icon' => 'file-lines'],
                    '/projects' => ['text' => 'Projects', 'icon' => 'laptop-code'],
                    '/about-me' => ['text' => 'About', 'icon' => 'user', 'sub-menu' => [
                        '/education' => ['text' => 'Education'],
                        '/employment' => ['text' => 'Employment'],
                        'separator-1' => '---',
                        '/about-me/salary' => ['text' => 'Salary Checker']
                    ]],
                    '/contact' => ['text' => 'Contact', 'icon' => 'envelope'],
                    'https://www.linkedin.com/in/michael-ragsdale-raggiesoft/' => ['text' => 'LinkedIn', 'icon' => 'linkedin', 'icon_brand' => true, 'is_external' => true]
                ]
            ],
            'book_viewer_controls' => [
                'items' => [
                    'previous_chapter_url' => ['text' => 'Previous', 'icon' => 'arrow-left'],
                    'table_of_contents_url' => ['text' => 'Contents', 'icon' => 'book'],
                    'next_chapter_url' => ['text' => 'Next', 'icon' => 'arrow-right'],
                ]
            ],
            // You can add more blocks here in the future, e.g., 'user_auth_buttons'
        ];
    }
}
