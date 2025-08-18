<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class MainMenu extends Component
{
    public array $nav_items = [];

    public function __construct()
    {
        // This is the data array from your old menu file
        $this->nav_items = [
            '/' => ['text' => 'Home', 'icon' => 'house'],
            '/resume' => ['text' => 'Résumé', 'icon' => 'file-lines'],
            '/projects' => ['text' => 'Projects', 'icon' => 'laptop-code'],
            '/about-me' => ['text' => 'About', 'icon' => 'user', 'sub-menu' => [
                '/education' => ['text' => 'Education'],
                '/employment' => ['text' => 'Employment'],
                'separator-1' => '---',
                '/about/salary' => ['text' => 'Salary Checker']
            ]],
            '/contact' => ['text' => 'Contact', 'icon' => 'envelope'],
            'https://www.linkedin.com/in/michael-ragsdale-raggiesoft/' => ['text' => 'LinkedIn', 'icon' => 'linkedin', 'icon_brand' => true, 'is_external' => true]
        ];
    }

    public function render(): View
    {
        // This passes the $nav_items variable to your component's view
        return view('components.main-menu');
    }
}
