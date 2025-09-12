<?php
// /elara/sarah.php

// --- Load Core Files ---
require_once __DIR__ . '/../clio/includes/config.php';
require_once __DIR__ . '/../clio/includes/functions.php';

// --- Initialize Page Data ---
$page_data = [];

// --- Routing & Page Configuration ---
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// --- Advanced Route: Handle Categorized Downloads ---
// This regex matches URLs like /downloads/category/file-slug
if (preg_match('#^/downloads/([^/]+)/([^/]+)$#', $request_uri, $matches)) {
    $category = $matches[1];
    $slug = $matches[2];

    // Pass the captured parts to the download script via the $_GET superglobal
    $_GET['category'] = $category;
    $_GET['file'] = $slug;
    
    // Execute the download script and stop further processing
    require __DIR__ . '/../clio/download.php';
    exit;
}


// --- Main Page Routing ---
switch ($request_uri) {
    case '/':
        $content_file = 'home.php';
        $page_data = [
            'page_title' => 'Home',
            'sidebar_file' => false
        ];
        break;

    case '/about':
        $content_file = 'about.php';
        $page_data = [
            'page_title' => 'About Me',
            'sidebar_file' => 'about.php'
        ];
        break;

    case '/resume':
        $content_file = 'resume.php';
        $page_data = [
            'page_title' => 'Résumé',
            'sidebar_file' => false
        ];
        break;

    default:
        $content_file = 'errors/404.php';
        $page_data = [
            'page_title' => 'Page Not Found',
            'sidebar_file' => false
        ];
        http_response_code(404);
        break;
}

// --- Render the Page ---
render_page($content_file, $page_data);

