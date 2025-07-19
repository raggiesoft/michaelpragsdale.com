<?php // --- template-content.php ---
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
      // Blueprint for standard content pages like About Me, Contact, Privacy Policy.

    // --- Page-Specific Variables ---
    $page_title = "Content Page Title - Michael Ragsdale"; 
    $body_class = "page-interior has-sidebar"; 
    $page_description = "A standard interior content page on Michael Ragsdale's portfolio.";

    // 1. Open the document
    include __DIR__ . '/includes/document-open.php';
    // 2. Add the site header
    include __DIR__ . '/includes/header.php';
?>
<div class="site-body-wrapper">
    <?php include __DIR__ . '/includes/sidebars/sidebar-default.php'; ?>
    <main class="site-content" id="content">
        <div class="container"> 
            <header class="page-header">
                <h1>Your Page Title Here</h1>
                <p class="lead">A brief, engaging subtitle for the page.</p>
            </header>
            <article class="content-area">
                <p>Your main page content, paragraphs, lists, etc., go here.</p>
            </article>
        </div>
    </main>
</div>
<?php
    // 4. Add the site footer & 5. Close the document
    include __DIR__ . '/includes/footer.php';
    include __DIR__ . '/includes/document-close.php';
?>