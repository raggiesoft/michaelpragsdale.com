<?php // --- /public/projects/storetrainer.php ---

    // --- Page-Specific Variables ---
    $page_title = "StoreTrainer - Michael Ragsdale"; 
    $body_class = "page-project-detail";
    
    // Load the 8-Bit Sunset theme for this page
    $supplemental_css_files = ['8-bit-sunset'];

    // --- Data Loading ---
    // Load all projects and find the StoreTrainer project
    $all_projects = json_decode(file_get_contents(__DIR__ . '/../assets/json/projects.json'), true) ?? [];
    $project = null;

    foreach ($all_projects as $p) {
        if ($p['id'] === 'store-trainer') {
            $project = $p;
            break;
        }
    }

    // Set the page description from the loaded project data
    $page_description = $project['short_description'] ?? 'A utility for launching PC game trainers and other companion applications.';

    // --- Handle 404 ---
    if (!$project) {
        header("HTTP/1.0 404 Not Found");
        include __DIR__ . '/../../errors/404.php';
        exit();
    }

    // --- Include Header ---
    include __DIR__ . '/../../includes/document-open.php';
    include __DIR__ . '/../../includes/header.php';
?>

<main class="site-content" id="content">
    <div class="container"> 
        <header class="page-header">
            <h1><?php echo htmlspecialchars($project['name']); ?></h1>
            <p class="lead"><?php echo htmlspecialchars($project['tagline']); ?></p>
        </header>

        <div class="project-detail-layout">

            <article class="project-main-content">
                <section class="resume-section">
                    <h2>About This Project</h2>
                    <p><?php echo nl2br(htmlspecialchars($project['details']['story'] ?? '')); ?></p>
                    
                    <?php if (!empty($project['details']['features'])): ?>
                        <h3>Key Features:</h3>
                        <ul>
                            <?php foreach ($project['details']['features'] as $feature): ?>
                                <li><?php echo htmlspecialchars($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </section>
            </article>

            <aside class="project-sidebar">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Project Info</h3>
                        <?php if (!empty($project['details']['tech_stack'])): ?>
                            <h4>Technology Stack</h4>
                            <ul class="project-tech-list">
                                <?php foreach ($project['details']['tech_stack'] as $tech): ?>
                                    <li><span class="tag"><?php echo htmlspecialchars($tech); ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if (!empty($project['details']['compatibility'])): ?>
                            <h4>Compatibility</h4>
                            <ul class="project-sidebar-list">
                                <?php foreach ($project['details']['compatibility'] as $item): ?>
                                    <li><?php echo htmlspecialchars($item); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($project['live_url'])): ?>
                    <div class="card-footer">
                        <a href="<?php echo htmlspecialchars($project['live_url']); ?>" class="button button-outline-primary">Visit Live Site</a>
                    </div>
                    <?php endif; ?>
                </div>
            </aside>

        </div>
    </div>
</main>

<?php
    // --- Include Footer ---
    include __DIR__ . '/../../includes/footer.php';
    include __DIR__ . '/../../includes/document-close.php';
?>
