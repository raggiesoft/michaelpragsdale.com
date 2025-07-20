<?php // --- projects/docx-converter/index.php ---

    // --- Find this specific project's data from our JSON file ---
    $project_id_to_find = 'docx-converter';
     $page_script = "live-code-embed";
    $all_projects = json_decode(file_get_contents(__DIR__ . '/../../assets/json/projects.json'), true) ?? [];

    $project = null;
    foreach ($all_projects as $p) {
        if (isset($p['id']) && $p['id'] === $project_id_to_find) {
            $project = $p;
            break;
        }
    }

    // Handle case where project isn't found
    if (!$project) { header("HTTP/1.0 404 Not Found"); exit("Project not found."); }

    // --- Page-Specific Variables ---
    $page_title = htmlspecialchars($project['name']) . " - Project Details"; 
    $body_class = "page-project-detail full-width"; 
    $page_description = htmlspecialchars($project['short_description']);

    include __DIR__ . '/../../includes/document-open.php';
    include __DIR__ . '/../../includes/header.php';
?>

<main class="site-content" id="content">
    <div class="container"> 
        <header class="page-header project-header">
            <h1><?php echo htmlspecialchars($project['name']); ?></h1>
            <p class="lead"><?php echo htmlspecialchars($project['tagline']); ?></p>
        </header>

        <div class="project-detail-layout">
            <article class="project-main-content">

                <section class="resume-section">
                    <h2>The Story</h2>
                    <p><?php echo htmlspecialchars($project['details']['story']); ?></p>
                </section>

                <section class="resume-section">
                    <h2>Key Features</h2>
                    <ul>
                        <?php foreach ($project['details']['features'] as $feature): ?>
                            <li><?php echo htmlspecialchars($feature); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </section>

                <section class="resume-section">
                    <h2>The Script</h2>
                    <p>The complete PowerShell script is displayed below, live from the project's GitHub repository.</p>

                    <div class="page-github-embed">
                        <pre class="line-numbers pre-wrap"><code id="script-container" class="language-powershell">Loading script...</code></pre>
                    </div>
                </section>

                </section>
            </article>

            <aside class="project-sidebar">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Project Info</h3>
                        <h4>Technology Stack</h4>
                        <ul class="project-tech-list">
                            <?php foreach ($project['details']['tech_stack'] as $tech): ?>
                                <li><span class="tag"><?php echo htmlspecialchars($tech); ?></span></li>
                            <?php endforeach; ?>
                        </ul>
                        <h4>Compatibility</h4>
                        <ul class="project-sidebar-list">
                            <?php foreach ($project['details']['compatibility'] as $item): ?>
                                <li><?php echo htmlspecialchars($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo htmlspecialchars($project['repo_url']); ?>" class="button button-outline-secondary">
                            <i class="fa-brands fa-github fa-fw"></i> View on GitHub
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</main>

<?php
    include __DIR__ . '/../../includes/footer.php';
    include __DIR__ . '/../../includes/document-close.php';
?>