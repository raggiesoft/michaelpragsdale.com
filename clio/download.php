<?php
// /clio/download.php - Secure File Download Handler

// --- Configuration ---
// Define the base path for protected files.
$protected_path = __DIR__ . '/protected_downloads/';

// Whitelist of allowed files to prevent directory traversal attacks.
// Only files in this array can be downloaded.
$allowed_files = [
    'project-brief.pdf' => 'Project Brief Q1.pdf', // filename => desired_download_name
    'secret-plans.docx' => 'World Domination.docx'
];

// --- Logic ---
// Get the requested filename from the URL query string (e.g., /download?file=project-brief.pdf)
$requested_file = $_GET['file'] ?? '';

// 1. Check if the file is in our whitelist
if (array_key_exists($requested_file, $allowed_files)) {
    
    // 2. Placeholder for permission check (e.g., check if a user is logged in)
    $user_has_permission = true; // Replace with your real authentication logic
    
    if ($user_has_permission) {
        $file_path = $protected_path . $requested_file;

        if (file_exists($file_path)) {
            // Set headers to force the browser to download the file
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $allowed_files[$requested_file] . '"');
            header('Content-Length: ' . filesize($file_path));
            
            // Read the file from its private location and output it to the browser
            readfile($file_path);
            exit;
        }
    }
}

// If file is not allowed, user doesn't have permission, or file doesn't exist, show a 404.
http_response_code(404);
require __DIR__ . '/404.php';
