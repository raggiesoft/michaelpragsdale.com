<?php
// /clio/includes/functions.php

/**
 * Renders a page by wrapping content in the master layout.
 *
 * NOTE: This function is now simpler. It no longer needs to load the config,
 * as that is handled by the router (sarah.php).
 *
 * @param string $content_file The name of the file in the 'pages' directory.
 * @param array  $data         An associative array of data to be extracted into variables.
 */
function render_page(string $content_file, array $data = []) {
    // Make the site configuration array (loaded by the router) available inside this function.
    global $site_config;
    
    $content_path = __DIR__ . '/../pages/' . $content_file;

    // Extract the page-specific data array into variables like $page_title.
    extract($data);

    if (file_exists($content_path)) {
        // Include the master layout.
        require_once __DIR__ . '/../partials/layout.php';
    } else {
        // Fallback for a missing content file.
        http_response_code(404);
        echo "Error: Content file not found.";
    }
}

