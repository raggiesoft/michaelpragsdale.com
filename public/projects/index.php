<?php // --- projects/index.php ---

    $page_title = "Projects - Michael Ragsdale"; 
    $body_class = "page-projects has-sidebar";
    $page_script = "project-filter";
    $page_description = "A showcase of web development projects by Michael Ragsdale, including custom websites, utilities, and applications.";
    
    // Include the header and opening HTML tags
    include __DIR__ . '/../includes/document-open.php';
    include __DIR__ . '/../includes/header.php';
    
    // Load the projects data from the JSON file
    $projects_json_path = __DIR__ . '/../assets/json/projects.json';
    $projects = [];
    if (file_exists($projects_json_path)) {
        $projects = json_decode(file_get_contents($projects_json_path), true) ?? [];
    }
?>

<div class="site-body-wrapper">
    <?php include __DIR__ . '/../includes/sidebars/sidebar-default.php'; ?>

    <main class="site-content" id="content">
        <div class="container"> 
            <header class="page-header">
                <h1>My Projects</h1>
                <p class="lead">A selection of applications and utilities I've built to solve problems and explore new technologies.</p>
            </header>

            <?php
                // --- Generate unique categories for the filter buttons ---
                $unique_tech = [];
                if (!empty($projects)) {
                    foreach ($projects as $project) {
                        // Ensure 'tech_stack' exists and is an array before looping
                        if (!empty($project['tech_stack']) && is_array($project['tech_stack'])) {
                            foreach ($project['tech_stack'] as $tech) {
                                if (!empty($tech)) {
                                    $key = strtolower(trim($tech));
                                    $unique_tech[$key] = $tech;
                                }
                            }
                        }
                    }
                }
                ksort($unique_tech); // Sort the technologies alphabetically
            ?>
            <div id="project-filter" class="filter-tabs">
                <span>Filter by:</span>
                <button class="button active" data-filter="all">All</button>
                <?php foreach ($unique_tech as $slug => $displayName): ?>
                    <button class="button" data-filter="<?php echo htmlspecialchars($slug); ?>">
                        <?php echo htmlspecialchars($displayName); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="auto-grid" id="project-list">
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                        
                        <div 
                            class="card clickable-card <?php if (!empty($project['is_featured'])) echo 'card-featured'; ?>" 
                            data-link="/projects/detail.php?id=<?php echo htmlspecialchars($project['id'] ?? ''); ?>"
                            data-category="<?php echo htmlspecialchars(strtolower(implode(' ', $project['tech_stack'] ?? []))); ?>"
                            role="link"
                            tabindex="0">
                            
                            <div class="card-body">
                                <h2 class="card-title h3"><?php echo htmlspecialchars($project['name']); ?></h2>
                                <?php // Use the null coalescing operator to fall back to 'description' if 'short_description' is missing ?>
                                <p class="card-text"><?php echo htmlspecialchars($project['short_description'] ?? $project['description'] ?? 'No description available.'); ?></p>
                                
                                <?php if (!empty($project['tech_stack']) && is_array($project['tech_stack'])): ?>
                                    <ul class="project-tech-list">
                                        <?php foreach ($project['tech_stack'] as $tech): ?>
                                            <li><span class="tag"><?php echo htmlspecialchars($tech); ?></span></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>

                            <?php 
                            // --- Card Footer with Live and Repo Links ---
                            // First, check if there are ANY links to show before creating the footer.
                            if (!empty($project['live_url']) || !empty($project['repo_url'])): 
                            ?>
                                <div class="card-footer">

                                    <?php // Independent check for the live URL ?>
                                    <?php if (!empty($project['live_url'])): ?>
                                        <a href="<?php echo htmlspecialchars($project['live_url']); ?>" class="button button-outline-primary">
                                            <i class="fa-duotone fa-browser fa-fw"></i> View Live
                                        </a>
                                    <?php endif; ?>

                                    <?php // Independent check for the repository URL ?>
                                    <?php if (!empty($project['repo_url'])): ?>
                                        <a href="<?php echo htmlspecialchars($project['repo_url']); ?>" class="button button-outline-secondary">
                                            <i class="fa-brands fa-github fa-fw"></i> View Code
                                        </a>
                                    <?php endif; ?>

                                </div>
                            <?php endif; // This closes the wrapper if statement ?>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <p>There are no projects to display at this time. Please check back later.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

<?php
    // Include the footer and closing HTML tags
    include __DIR__ . '/../includes/footer.php';
    include __DIR__ . '/../includes/document-close.php';
?>
