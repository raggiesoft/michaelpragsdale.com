<?php // --- template-detail.php ---
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
      // Blueprint for a single item's detail page (e.g., one product, one project).

   // --- Page-Specific Variables ---
    $page_title = "Detail Page Title - Michael Ragsdale"; 
    $body_class = "page-detail has-sidebar";
    $page_description = "Details about a specific item in the portfolio.";

    // --- NEW: Set OG type and extra tags for this page type ---
    $og_type = 'article';
    $extra_meta_tags = [
        'article:author' => 'Michael Ragsdale',
        'article:published_time' => date('c'), // Use the current time as a placeholder
        'article:tag' => 'Web Development' // Example tag
    ];

    // 1. Open the document & 2. Add the header
    include __DIR__ . '/includes/document-open.php';
    include __DIR__ . '/includes/header.php';
?>
<div class="site-body-wrapper">
    <?php 
        // For a detail page, you would include the relevant "single item" sidebar.
        // Example for a single product page:
        include __DIR__ . '/includes/sidebars/sidebar-product-single.php'; 
    ?>
    <main class="site-content" id="content">
        <div class="container"> 
            <article class="content-area">
                <header class="page-header">
                    <h1>Specific Item Title</h1>
                    <p class="lead">A compelling one-sentence summary of this item.</p>
                </header>

                <figure>
                    <img src="https://via.placeholder.com/800x400" alt="Placeholder for a featured image of the item">
                    <figcaption>Optional caption for the featured image.</figcaption>
                </figure>
                
                <h2>About This Item</h2>
                <p>This is where the detailed description goes. You can have multiple paragraphs, headings, lists, images, and other rich content to fully describe the item.</p>

                <h3 id="screenshots">Screenshots</h3>
                <p>Content for the screenshots section.</p>

                <h3 id="demo">Demo</h3>
                <p>Content for the demo section.</p>
                
            </article>
        </div>
    </main>
</div>
<?php
    // 4. Add the footer & 5. Close the document
    include __DIR__ . '/includes/footer.php';
    include __DIR__ . '/includes/document-close.php';
?>