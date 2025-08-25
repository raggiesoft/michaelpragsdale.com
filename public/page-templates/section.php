<?php // --- template-section.php ---
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
      // Blueprint for section pages that list multiple items (e.g., all products, all services).

    // --- Page-Specific Variables ---
    $page_title = "Section Title - Michael Ragsdale"; 
    $body_class = "page-section has-sidebar";
    $page_description = "A list of items within a specific section of the portfolio.";

    // 1. Open the document & 2. Add the header
    include __DIR__ . '/includes/document-open.php';
    include __DIR__ . '/includes/header.php';
?>
<div class="site-body-wrapper">
    <?php 
        // For a section page, you would include the relevant section sidebar.
        // Example for a products section:
        include __DIR__ . '/includes/sidebars/sidebar-product-list.php'; 
    ?>
    <main class="site-content" id="content">
        <div class="container"> 
            <header class="page-header">
                <h1>Your Section Title</h1>
                <p class="lead">An introduction to this collection of items.</p>
            </header>

            <?php // --- Item Grid Starts Here --- ?>
            <div class="row" style="--grid-gutter-y: var(--spacing-lg);">
                
                <?php
                    // In a real page copied from this template, you would have a
                    // PHP loop here to fetch and display data for your items.
                    // Example placeholder:
                    for ($i = 1; $i <= 4; $i++) {
                ?>
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title h3">Item <?php echo $i; ?> Title</h2>
                                <p class="card-text">A short description of this item, which would come from your data source.</p>
                                <a href="#" class="button button-outline-primary stretched-link">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php 
                    } // End example loop
                ?>

            </div> <?php // End .row ?>
        </div>
    </main>
</div>
<?php
    // 4. Add the footer & 5. Close the document
    include __DIR__ . '/includes/footer.php';
    include __DIR__ . '/includes/document-close.php';
?>