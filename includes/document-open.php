<?php // --- includes/document-open.php ---
/**
 * My Portfolio Website
 *
 * This file is part of My Portfolio Website.
 *
 * My Portfolio Website is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 * @copyright Copyright (c) 2025 Michael Ragsdale
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */
    // --- Meta & Open Graph Defaults ---
    // These are the site-wide defaults. They can be overridden by variables
    // set on individual pages before this file is included.
    $site_name = "Michael Ragsdale's Portfolio";
    $default_description = "The official portfolio of Michael Ragsdale, showcasing RaggieSoft products, professional services, and web development expertise.";
    
    // Suggestion: Create a default social sharing image (1200x630px is ideal) and place it here.
    $default_og_image_path = '/assets/images/social-share-default.jpg'; 

    // --- Page-Specific Variable Processing ---
    // Use the null coalescing operator (??) to fall back to the defaults if a variable isn't set on the page.
    $page_title = isset($page_title) ? htmlspecialchars($page_title) : "Michael Ragsdale";
    $page_description = isset($page_description) ? htmlspecialchars($page_description) : $default_description;
    
    // Dynamically construct the full, canonical URL of the current page.
    // strtok() is used to remove any query parameters (like ?foo=bar) for a cleaner URL.
    $canonical_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . strtok($_SERVER["REQUEST_URI"], '?');

    // Set Open Graph variables, using page-specific values or falling back to defaults.
    $og_title = $page_title;
    $og_description = $page_description;
    $og_url = $canonical_url;
    // Prepend the domain to the image path to create a full URL, which OG tags require.
    $og_image_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . (isset($og_image_path) ? $og_image_path : $default_og_image_path);
    $og_type = isset($og_type) ? $og_type : 'website';

    // Process other variables needed by the template.
    $body_class = isset($body_class) ? htmlspecialchars($body_class) : "";
    $supplemental_css_files = isset($supplemental_css_files) ? $supplemental_css_files : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>

    <meta name="description" content="<?php echo $page_description; ?>">
    <link rel="canonical" href="<?php echo $canonical_url; ?>">

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Ragsdale" />
    <link rel="manifest" href="/site.webmanifest" />

    <meta property="og:type" content="<?php echo $og_type; ?>">
    <meta property="og:url" content="<?php echo $og_url; ?>">
    <meta property="og:title" content="<?php echo $og_title; ?>">
    <meta property="og:description" content="<?php echo $og_description; ?>">
    <meta property="og:image" content="<?php echo $og_image_url; ?>">
    <meta property="og:site_name" content="<?php echo $site_name; ?>">

    <?php // --- NEW: Loop for extra, type-specific meta tags ---

        // Check if the page has defined an array of extra tags
        if (isset($extra_meta_tags) && is_array($extra_meta_tags)) {
            foreach ($extra_meta_tags as $property => $content) {
                // Make sure we have content before printing the tag
                if (!empty($content)) {
                    // Sanitize the output and print the meta tag
                    echo '<meta property="' . htmlspecialchars($property) . '" content="' . htmlspecialchars($content) . '">' . "\n\t\t";
                }
            }
        }
    ?>

    <meta name="theme-color" content="#12445B"> <?php // Your dark RaggieSoft Blue ?>
    
    <link rel="stylesheet" href="/assets/css/main.css">
    <?php
        // This loop loads any supplemental theme stylesheets (like frutiger-aero.css)
        foreach ($supplemental_css_files as $css_file_name) {
            echo '<link rel="stylesheet" href="/assets/css/themes/' . htmlspecialchars($css_file_name) . '.css">';
        }
    ?>

    <script src="https://kit.fontawesome.com/ec060982d4.js" crossorigin="anonymous"></script>
</head>
<body class="<?php echo htmlspecialchars($body_class); ?>" <?php if (isset($page_script)) { echo 'data-page-script="' . htmlspecialchars($page_script) . '"'; } ?>>
    
    <a href="#content" class="skip-link">Skip to Main Content</a>

    <div class="page-container">