<?php
// /clio/download.php - Secure File Download Handler

// --- Configuration ---
$protected_base_path = __DIR__ . '/protected-downloads/';

// Load the categorized file manifest.
$categorized_manifest = require __DIR__ . '/download-manifest.php';

// --- Logic ---
$requested_category = $_GET['category'] ?? '';
$requested_slug = $_GET['file'] ?? '';

// 1. Check if the requested category and slug exist in our manifest.
if (
    isset($categorized_manifest[$requested_category]) &&
    isset($categorized_manifest[$requested_category][$requested_slug])
) {
    
    // AUTHENTICATION HOOK
    $user_has_permission = true; // Your real authentication logic goes here.
    
    if ($user_has_permission) {
        $file_info = $categorized_manifest[$requested_category][$requested_slug];
        
        // --- Determine Content Disposition ---
        // Default to forcing a download.
        $disposition = 'attachment'; 
        
        // Check for a user request (e.g., ?action=view) and if the file is allowed to be inline.
        $requested_action = $_GET['action'] ?? 'download';
        if ($requested_action === 'view' && !empty($file_info['allow_inline'])) {
            $disposition = 'inline';
        }
        
        // Construct the full, secure path using the 'disk_path'
        $file_path = $protected_base_path . $file_info['disk_path'] . '/' . $file_info['disk_filename'];

        if (file_exists($file_path)) {
            header('Content-Type: ' . $file_info['mime_type']);
            // Use the determined disposition ('inline' or 'attachment') in the header
            header('Content-Disposition: ' . $disposition . '; filename="' . $file_info['download_name'] . '"');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
            exit;
        }
    }
}

// If anything fails, show a 404 error.
http_response_code(404);
require __DIR__ . '/errors/404.php';

