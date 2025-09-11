<?php
// /elara/sarah.php

// --- Load Core Files ---
require_once __DIR__ . '/../clio/includes/config.php';
require_once __DIR__ . '/../clio/includes/functions.php';

// --- Initialize Page Data ---
$page_data = [];

// --- Routing & Page Configuration ---
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// ... (cleanup logic for URI) ...

switch ($request_uri) {
    case '/':
        $content_file = 'home.php';
        $page_data = [
            'page_title' => 'Home',
            'sidebar_file' => false // No sidebar on the home page
        ];
        break;

    case '/about':
        $content_file = 'about.php';
        $page_data = [
            'page_title' => 'About Me',
            'sidebar_file' => 'about.php' // This page requests a SPECIFIC sidebar
        ];
        break;

    case '/resume':
        $content_file = 'resume.php';
        $page_data = [
            'page_title' => 'Résumé',
            'sidebar_file' => false // This page requests NO sidebar
        ];
        break;

    default:
        $content_file = 'errors/404.php';
        $page_data = [
            'page_title' => 'Page Not Found',
            'sidebar_file' => false // No sidebar on the 404 page
        ];
        http_response_code(404);
        break;
}

// --- Render the Page ---
render_page($content_file, $page_data);

