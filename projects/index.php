<?php // --- projects/index.php ---

    $page_title = "Projects - Michael Ragsdale"; 
    $body_class = "page-projects has-sidebar";
    $page_script = "project-filter";
    $page_description = "A showcase of web development projects by Michael Ragsdale, including custom websites, utilities, and applications.";
    
    include __DIR__ . '/../includes/document-open.php';
    include __DIR__ . '/../includes/header.php';
    
    $projects = json_decode(file_get_contents(__DIR__ . '/../assets/json/projects.json'), true) ?? [];
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
                // Generate unique categories from the projects' tech_stack
                $unique_tech = [];
                if (!empty($projects)) {
                    foreach ($projects as $project) {
                        if (!empty($project['tech_stack'])) {
                            foreach ($project['tech_stack'] as $tech) {
                                if (!empty($tech)) {
                                    $key = strtolower(trim($tech));
                                    $unique_tech[$key] = $tech;
                                }
                            }
                        }
                    }
                }
                ksort($unique_tech);
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
                                <p class="card-text"><?php echo htmlspecialchars($project['short_description'] ?? $project['description']); ?></p>
                                
                                <?php if (!empty($project['tech_stack'])): ?>
                                    <ul class="project-tech-list">
                                        <?php foreach ($project['tech_stack'] as $tech): ?>
                                            <li><span class="tag"><?php echo htmlspecialchars($tech); ?></span></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>

                            <?php // We show EITHER a link to the code repo OR a link to the live version if it exists, but not both on this card. The detail page has both. ?>
                            <?php if (!empty($project['repo_url'])): ?>
                                <div class="card-footer">
                                    <a href="<?php echo htmlspecialchars($project['repo_url']); ?>" class="button button-outline-secondary">
                                        <i class="fa-brands fa-github fa-fw"></i> View Code
                                    </a>
                                </div>
                            <?php elseif (!empty($project['live_url'])): ?>
                                <div class="card-footer">
                                    <a href="<?php echo htmlspecialchars($project['live_url']); ?>" class="button button-outline-primary">
                                        View Live
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

<?php
    include __DIR__ . '/../includes/footer.php';
    include __DIR__ . '/../includes/document-close.php';
?>