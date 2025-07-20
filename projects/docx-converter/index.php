<?php // --- projects/docx-converter/index.php (Corrected Version) ---

    // --- Find this specific project's data from our JSON file ---
    $project_id_to_find = 'docx-converter';
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
    $body_class = "page-project-detail has-sidebar"; // Changed to has-sidebar
    $page_script = "live-code-embed";
    $page_description = htmlspecialchars($project['short_description']);
    
    include __DIR__ . '/../../includes/document-open.php';
    include __DIR__ . '/../../includes/header.php';
?>

<?php // This wrapper is essential for the main content + sidebar layout ?>
<div class="site-body-wrapper">

    <?php include __DIR__ . '/../../includes/sidebars/project-detail.php'; ?>

    <main class="site-content" id="content">
        <div class="container"> 
            <header class="page-header project-header">
                <h1><?php echo htmlspecialchars($project['name']); ?></h1>
                <p class="lead"><?php echo htmlspecialchars($project['tagline']); ?></p>
            </header>

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

            </article>
        </div>
    </main>

</div> <?php // End of .site-body-wrapper ?>

<?php
    include __DIR__ . '/../../includes/footer.php';
    include __DIR__ . '/../../includes/document-close.php';
?>