<?php // --- projects/detail.php (Flexible Version) ---

    // --- Find the correct project to display ---
    $project_id = $_GET['id'] ?? null;
    $all_projects = json_decode(file_get_contents(__DIR__ . '/../assets/json/projects.json'), true) ?? [];
    
    $project = null;
    if ($project_id) {
        foreach ($all_projects as $p) {
            if (isset($p['id']) && $p['id'] === $project_id) {
                $project = $p;
                break;
            }
        }
    }

    // --- If no project was found, show a 404 error ---
    if (!$project) {
        header("HTTP/1.0 404 Not Found");
        $page_title = "Project Not Found";
        include __DIR__ . '/../includes/document-open.php';
        include __DIR__ . '/../includes/header.php';
        echo '<main class="site-content" id="content"><div class="container"><header class="page-header"><h1>Project Not Found</h1><p class="lead">Sorry, the project you were looking for could not be found.</p></header></div></main>';
        include __DIR__ . '/../includes/footer.php';
        include __DIR__ . '/../includes/document-close.php';
        exit();
    }

    // --- Page-Specific Variables ---
    $page_title = htmlspecialchars($project['name']) . " - Project Details"; 
    $body_class = "page-project-detail full-width"; 
    $page_description = htmlspecialchars($project['short_description'] ?? $project['description']);
    
    include __DIR__ . '/../includes/document-open.php';
    include __DIR__ . '/../includes/header.php';
?>

<main class="site-content" id="content">
    <div class="container"> 
        <header class="page-header project-header">
            <h1><?php echo htmlspecialchars($project['name']); ?></h1>
            <p class="lead"><?php echo htmlspecialchars($project['tagline']); ?></p>
        </header>

        <div class="project-detail-layout">
            <article class="project-main-content">
                
                <?php 
                    // Use the detailed 'story' if it exists, otherwise fall back to the main 'description'.
                    $main_content = $project['details']['story'] ?? $project['description'] ?? 'No further details are available for this project.';
                ?>
                <section class="resume-section">
                    <h2>About This Project</h2>
                    <p><?php echo nl2br(htmlspecialchars($main_content)); ?></p>
                </section>

                <?php // Only show the "Features" section if it exists in the 'details' object ?>
                <?php if (!empty($project['details']['features'])): ?>
                    <section class="resume-section">
                        <h2>Key Features</h2>
                        <ul>
                            <?php foreach ($project['details']['features'] as $feature): ?>
                                <li><?php echo htmlspecialchars($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </section>
                <?php endif; ?>

            </article>

            <aside class="project-sidebar">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Project Info</h3>
                        
                        <?php 
                            // Use the 'tech_stack' from inside 'details' if it exists, otherwise use the top-level one.
                            $tech_stack = $project['details']['tech_stack'] ?? $project['tech_stack'] ?? [];
                        ?>
                        <?php if (!empty($tech_stack)): ?>
                            <h4>Technology Stack</h4>
                            <ul class="project-tech-list">
                                <?php foreach ($tech_stack as $tech): ?>
                                    <li><span class="tag"><?php echo htmlspecialchars($tech); ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php // Only show "Compatibility" if it exists in the 'details' object ?>
                        <?php if (!empty($project['details']['compatibility'])): ?>
                            <h4>Compatibility</h4>
                            <ul class="project-sidebar-list">
                                <?php foreach ($project['details']['compatibility'] as $item): ?>
                                    <li><?php echo htmlspecialchars($item); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($project['live_url']) || !empty($project['repo_url'])): ?>
                        <div class="card-footer">
                            <?php if (!empty($project['live_url'])): ?>
                                <a href="<?php echo htmlspecialchars($project['live_url']); ?>" class="button button-outline-primary">View Live</a>
                            <?php endif; ?>
                            <?php if (!empty($project['repo_url'])): ?>
                                <a href="<?php echo htmlspecialchars($project['repo_url']); ?>" class="button button-outline-secondary">View Code</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </aside>
        </div>
    </div>
</main>

<?php
    include __DIR__ . '/../includes/footer.php';
    include __DIR__ . '/../includes/document-close.php';
?>