<?php
// /clio/download.php - Secure File Download Handler

// --- Configuration ---
$protected_path = __DIR__ . '/protected_downloads/';

/*
 * --- Common MIME Types ---
 * .pdf  => application/pdf
 * .zip  => application/zip
 * .7z   => application/x-7z-compressed
 * .docx => application/vnd.openxmlformats-officedocument.wordprocessingml.document
 * .xlsx => application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
 * .exe  => application/vnd.microsoft.portable-executable
 * .msi  => application/x-msi
 * .png  => image/png
 * .jpg  => image/jpeg
 * For unknown binary files, the safe default is: application/octet-stream
*/

// Whitelist mapping URL slugs to all distributable files.
$allowed_files = [
    // 'url-slug' => [
    //     'disk_filename' => 'the-real-file.ext',
    //     'download_name' => 'The Name The User Sees.ext',
    //     'mime_type'     => 'application/some-type'
    // ],
    /* --- Your Application Suite (InstallAware Web Deployment) --- */
    'my-app-installer' => [
        'disk_filename' => 'setup.exe',
        'download_name' => 'MyApp_Installer.exe',
        'mime_type'     => 'application/vnd.microsoft.portable-executable'
    ],
    'my-app-data-chunk-1' => [
        'disk_filename' => 'data.7zip', // The first chunk
        'download_name' => 'data.7zip',
        'mime_type'     => 'application/x-7z-compressed'
    ],
    'my-app-data-chunk-2' => [
        'disk_filename' => 'data2.7zip', // The second chunk
        'download_name' => 'data2.7zip',
        'mime_type'     => 'application/x-7z-compressed'
    ],
    'dotnet-runtime-chunk' => [
        'disk_filename' => 'dotnet6_runtime.7zip',
        'download_name' => 'dotnet6_runtime.7zip',
        'mime_type'     => 'application/x-7z-compressed'
    ],

    /* --- Other General Downloads --- */
    'mragsdale-resume' => [
        'disk_filename' => 'mragsdale-resume-latest.pdf',
        'download_name' => 'Michael Ragsdale - Resume.pdf',
        'mime_type'     => 'application/pdf'
    ],
    'source-code-archive' => [
        'disk_filename' => 'source-v2.1.7z',
        'download_name' => 'Source Code v2.1.7z',
        'mime_type'     => 'application/x-7z-compressed'
    ]
];

// --- Logic ---
$requested_slug = $_GET['file'] ?? '';

if (array_key_exists($requested_slug, $allowed_files)) {
    
    // AUTHENTICATION HOOK: This is where you can protect your paid software.
    // The setup.exe could pass a license key as a parameter, which you verify here.
    $user_has_permission = true; // Example: check_license_key($_GET['license'] ?? '');
    
    if ($user_has_permission) {
        $file_info = $allowed_files[$requested_slug];
        $file_path = $protected_path . $file_info['disk_filename'];

        if (file_exists($file_path)) {
            header('Content-Type: ' . $file_info['mime_type']);
            header('Content-Disposition: attachment; filename="' . $file_info['download_name'] . '"');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
            exit;
        }
    }
}

http_response_code(404);
require __DIR__ . '/errors/404.php';

