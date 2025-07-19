<?php // --- employment/index.php ---

    // --- Page-Specific Variables ---
    $page_title = "Employment History - Michael Ragsdale"; 
    $body_class = "page-employment has-sidebar";
    $page_script = "employment-filter";
    $page_description = "A detailed summary of Michael Ragsdale's professional work experience, including roles in web development and customer service.";

    // 1. Open the document
    include __DIR__ . '/../includes/document-open.php';

    // 2. Add the site header
    include __DIR__ . '/../includes/header.php';
?>

<?php // 3. Assemble the main body content (sidebar + main content area) ?>
<div class="site-body-wrapper">

    <?php include __DIR__ . '/../includes/sidebars/sidebar-default.php'; ?>

    <main class="site-content" id="content">
        <div class="container"> 
            
            <header class="page-header">
                <h1>Employment History</h1>
                <p class="lead">My professional journey and key roles. Use the filters to highlight relevant experience.</p>
            </header>

            <?php
                // --- Part A: Read ALL job data from the JSON file ---
                $all_jobs = json_decode(file_get_contents(__DIR__ . '/../assets/json/employment.json'), true) ?? [];

                // --- Part B: Filter for only public jobs ---
                $jobs = array_filter($all_jobs, function($job) {
                    return $job['is_public'] ?? false;
                });

                // --- Part C: Dynamically generate filter categories from the PUBLIC jobs ---
                $unique_categories = [];
                if (!empty($jobs)) {
                    foreach ($jobs as $job) {
                        if (!empty($job['categories'])) {
                            $categories_for_job = explode(' ', $job['categories']);
                            foreach ($categories_for_job as $category) {
                                if (!empty($category)) $unique_categories[$category] = true;
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
                    
                    <?php // --- Part E: Render the PUBLIC Job History List --- ?>
                    <?php if (!empty($jobs)): ?>
                        <?php foreach ($jobs as $job): ?>
                            <?php
                                // We need the priority class function here as well
                                if (!function_exists('get_history_item_priority_class')) {
                                    function get_history_item_priority_class($categories_string) {
                                        if (str_contains($categories_string, 'current-employer')) return 'is-current';
                                        if (str_contains($categories_string, 'volunteer') || str_contains($categories_string, 'internship')) return 'is-highlighted';
                                        return 'is-default';
                                    }
                                }
                                $priority_class = get_history_item_priority_class($job['categories']);
                            ?>
                            <li class="history-item <?php echo $priority_class; ?>" data-category="<?php echo htmlspecialchars($job['categories']); ?>">
                                <div class="history-item__period"><?php echo htmlspecialchars($job['period']); ?></div>
                                <div class="history-item__content">
                                    <div class="history-item__header">
                                        <img class="history-item__logo" src="/<?php echo htmlspecialchars($job['logo']); ?>" alt="<?php echo htmlspecialchars($job['company']); ?> logo">
                                        <div class="history-item__header-text">
                                            <h2 class="history-item__title"><?php echo htmlspecialchars($job['company']); ?></h2>
                                            <div class="history-item__subtitle"><?php echo htmlspecialchars($job['location']); ?></div>
                                        </div>
                                    </div>
                                    <div class="history-item__tags">
                                        <?php /* tag rendering logic */ ?>
                                    </div>
                                    <ul class="role-list">
                                        <?php foreach ($job['roles'] as $role): ?>
                                            <li class="role-item">
                                                <h3 class="role-title"><?php echo htmlspecialchars($role['title']); ?></h3>
                                                <div class="role-period"><?php echo htmlspecialchars($role['period']); ?></div>
                                                <ul class="role-description">
                                                    <?php 
                                                        // Default to showing the IT description on this page
                                                        $description_to_show = $role['description']['it'] ?? [];
                                                        foreach ($description_to_show as $bullet):
                                                    ?>
                                                        <li><?php echo htmlspecialchars($bullet); ?></li>
                                                    <?php endforeach; ?>
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

</div>

<?php
    include __DIR__ . '/../includes/footer.php';
    include __DIR__ . '/../includes/document-close.php';
?>