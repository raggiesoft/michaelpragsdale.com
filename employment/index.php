<?php // --- employment/index.php ---
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
    // --- Page-Specific Variables ---
    $page_title = "Employment History - Michael Ragsdale"; 
    $body_class = "page-employment has-sidebar"; 
    $page_description = "A detailed summary of Michael Ragsdale's professional work experience, including roles in web development, information technology, and customer service.";
    $supplemental_css_files = ['frutiger-aero'];
    $page_script = 'employment-filter';

    // 1. Open the document
    // We go up one directory ('..') to find the /includes/ folder
    include __DIR__ . '/../includes/document-open.php';

    // 2. Add the site header
    include __DIR__ . '/../includes/header.php';
?>

<?php // 3. Assemble the main body content (sidebar + main content area) ?>
<div class="site-body-wrapper">

    <?php 
        // We're using the default sidebar for this page.
        include __DIR__ . '/../includes/sidebars/sidebar-default.php'; 
    ?>

    <main class="site-content" id="content">
        <div class="container"> 
            
            <header class="page-header">
                <p class="lead">My professional journey and key roles. Use the filters to highlight relevant experience.</p>
            </header>

            <?php
                // --- Part A: Read job data from the JSON file ---
                $jobs_json_path = __DIR__ . '/../assets/json/employment.json';
                $jobs = []; // Initialize an empty array to hold our jobs

                if (file_exists($jobs_json_path)) {
                    $jobs_json_string = file_get_contents($jobs_json_path);
                    $jobs = json_decode($jobs_json_string, true);

                    if ($jobs === null) { // Handle cases where JSON is invalid
                        $jobs = [];
                        error_log("Error: Malformed JSON in employment.json");
                    }
                } else {
                    error_log("Error: Could not find " . $jobs_json_path);
                }

                // --- Part B: Helper function to determine the highest-priority class ---
                function get_history_item_priority_class($categories_string) {
                    // Level 1 Priority: Current Employer
                    if (str_contains($categories_string, 'current-employer')) {
                        return 'is-current';
                    }
                    // Level 2 Priority: Volunteer or Internship
                    if (str_contains($categories_string, 'volunteer') || str_contains($categories_string, 'internship')) {
                        return 'is-highlighted';
                    }
                    // Level 3 (Default)
                    return 'is-default';
                }

                // --- Part C: Dynamically generate the list of unique filter categories ---
                $unique_categories = [];
                if (!empty($jobs)) {
                    foreach ($jobs as $job) {
                        $categories_for_job = explode(' ', $job['categories']);
                        foreach ($categories_for_job as $category) {
                            if (!empty($category)) {
                                $unique_categories[$category] = true;
                            }
                        }
                    }
                }
                $unique_categories = array_keys($unique_categories);
                sort($unique_categories);
            ?>

            <?php // --- Part D: Render the Filter Tabs --- ?>
            <div id="employment-filter" class="filter-tabs">
                <span>Filter by:</span>
                <button class="button active" data-filter="all">All</button>
                
                <?php foreach ($unique_categories as $category): ?>
                    <button class="button" data-filter="<?php echo htmlspecialchars($category); ?>">
                        <?php echo htmlspecialchars(ucwords(str_replace('-', ' ', $category))); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <section class="history-section">
                <ul class="history-list" id="employment-list">
                    
                    <?php // --- Part E: Render the Job History List --- ?>
                    <?php if (!empty($jobs)): ?>
                        <?php foreach ($jobs as $job): ?>
                            <?php
                                // Get the priority class for this specific job entry
                                $priority_class = get_history_item_priority_class($job['categories']);
                            ?>
                            <li class="history-item <?php echo $priority_class; ?>" data-category="<?php echo htmlspecialchars($job['categories']); ?>">
                                <div class="history-item__period"><?php echo $job['period']; ?></div>
                                <div class="history-item__content">
                                    
                                    <div class="history-item__header">
                                        <img class="history-item__logo" src="/<?php echo htmlspecialchars($job['logo']); ?>" alt="<?php echo htmlspecialchars($job['company']); ?> logo">
                                        <div class="history-item__header-text">
                                            <h2 class="history-item__title"><?php echo $job['company']; ?></h2>
                                            <div class="history-item__subtitle"><?php echo $job['location']; ?></div>
                                        </div>
                                    </div>

                                    <div class="history-item__tags">
                                        <?php 
                                            $tags = explode(' ', $job['categories']);
                                            $tag_count = count($tags);
                                            
                                            if ($tag_count > 0 && !empty(trim($job['categories']))):
                                                $label = ($tag_count > 1) ? 'Categories:' : 'Category:';
                                                echo '<span class="tags-label">' . $label . '</span>';

                                                $html_tags = [];
                                                foreach ($tags as $tag) {
                                                    $tag_text = htmlspecialchars(ucwords(str_replace('-', ' ', $tag)));
                                                    $html_tags[] = '<span class="tag tag-' . htmlspecialchars($tag) . '">' . $tag_text . '</span>';
                                                }
                                                echo implode(', ', $html_tags);
                                            endif;
                                        ?>
                                    </div>
                                    
                                    <ul class="role-list">
                                        <?php foreach ($job['roles'] as $role): ?>
                                            <li class="role-item">
                                                <h3 class="role-title"><?php echo $role['title']; ?></h3>
                                                <div class="role-period"><?php echo $role['period']; ?></div>
                                                <ul class="role-description">
                                                    <?php
                                                        // Check if the 'it' description list exists and is an array before looping.
                                                        // This prevents errors if a job entry ever omits it.
                                                        if (isset($role['description']['it']) && is_array($role['description']['it'])) {
                                                            // We are specifically looping through the 'it' array now.
                                                            foreach ($role['description']['it'] as $bullet):
                                                    ?>
                                                        <li><?php echo htmlspecialchars($bullet); ?></li>
                                                    <?php
                                                            endforeach;
                                                        }
                                                    ?>
                                                </ul>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>There is no employment history to display at this time.</p>
                    <?php endif; ?>

                </ul>
            </section>

        </div>
    </main>

</div> <?php // End of .site-body-wrapper ?>

<?php
    // 4. Add the site footer
    include __DIR__ . '/../includes/footer.php';

    // 5. Close the document
    include __DIR__ . '/../includes/document-close.php';
?>