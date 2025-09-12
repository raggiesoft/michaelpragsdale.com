<?php
// /clio/download_manifest.php
// This file contains the whitelist of all available downloads.
// 'disk_path' now specifies the subdirectory within the protected downloads folder.

return [
    /**
     * Application Installers & Chunks
     * Files related to your InstallAware software package.
     */
    'application_suite' => [
        'my-app-installer' => [
            'disk_path'     => 'application_suite', // Maps to /protected_downloads/application_suite/
            'disk_filename' => 'setup.exe',
            'download_name' => 'MyApp_Installer.exe',
            'mime_type'     => 'application/vnd.microsoft.portable-executable'
        ],
        'my-app-data-chunk-1' => [
            'disk_path'     => 'application_suite',
            'disk_filename' => 'data.7zip',
            'download_name' => 'data.7zip',
            'mime_type'     => 'application/x-7z-compressed'
        ],
        // ... other chunks would follow the same pattern
    ],

    /**
     * General Documents & Archives
     * Miscellaneous files like resumes, source code, etc.
     */
    'general_files' => [
        'mragsdale-resume' => [
            'disk_path'     => 'general_files', // Maps to /protected_downloads/general_files/
            'disk_filename' => 'mragsdale-resume-latest.pdf',
            'download_name' => 'Michael Ragsdale - Resume.pdf',
            'mime_type'     => 'application/pdf',
            'allow_inline'  => true // <-- NEW: This flag permits this file to be viewed in the browser.
        ],
        'source-code-archive' => [
            'disk_path'     => 'general_files',
            'disk_filename' => 'source-v2.1.7z',
            'download_name' => 'Source Code v2.1.7z',
            'mime_type'     => 'application/x-7z-compressed'
            // No 'allow_inline' key here, so it will always download.
        ]
    ]
];

