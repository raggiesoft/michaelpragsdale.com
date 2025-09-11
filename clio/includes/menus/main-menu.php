<?php
// /clio/menus/main-menu.php

// This is the central data source for your main navigation menu.
$nav_items = [
    '/' => [
        'text' => 'Home',
        'icon' => 'house'
    ],
    '/resume' => [
        'text' => 'Résumé',
        'icon' => 'file-lines'
    ],
    '/projects' => [
        'text' => 'Projects',
        'icon' => 'laptop-code',
        'sub-menu' => [
            '/projects/docx-converter' => ['text' => 'DOCX Converter'],
            '/projects/servers'      => ['text' => 'Server Infrastructure'],
        ]
    ],
    '/about' => [
        'text' => 'About',
        'icon' => 'user',
        'sub-menu' => [
            '/education' => ['text' => 'Education'],
            '/employment'  => ['text' => 'Employment'],
        ]
    ],
    '/contact' => [
        'text' => 'Contact',
        'icon' => 'envelope',
        'sub-menu' => [
            'https://github.com/raggiesoft' => [
                'text'       => 'GitHub',
                'icon'       => 'github',
                'icon_brand' => true,
                'is_external'=> true
            ],
        ]
    ]
];

