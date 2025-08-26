<?php // --- /public/projects/servers.php ---

    // --- Page-Specific Variables ---
    $page_title = "Server Infrastructure - Michael Ragsdale"; 
    $body_class = "page-project-detail";
    $page_description = "An overview of the server infrastructure projects by Michael Ragsdale, including a Laravel Forge managed server and a self-managed Linux server.";
    
    // Load the Monokai Pro theme for this page
    $supplemental_css_files = ['monokai-pro'];

    // --- Data Loading ---
    // Load all projects and find the two server projects
    $all_projects = json_decode(file_get_contents(__DIR__ . '/../assets/json/projects.json'), true) ?? [];
    $bold_firefly = null;
    $glowing_galaxy = null;

    foreach ($all_projects as $project) {
        if ($project['id'] === 'bold-firefly') {
            $bold_firefly = $project;
        }
        if ($project['id'] === 'glowing-galaxy') {
            $glowing_galaxy = $project;
        }
    }

    // --- Include Header ---
    include __DIR__ . '/../../includes/document-open.php';
    include __DIR__ . '/../../includes/header.php';
?>

<main class="site-content" id="content">
    <div class="container"> 
        <header class="page-header">
            <h1>Server Infrastructure</h1>
            <p class="lead">A look at the cloud-based servers I provisioned and configured to host my web applications, demonstrating skills in both automated and manual server management.</p>
        </header>

        <div class="project-detail-layout">

            <!-- Bold Firefly Section -->
            <?php if ($bold_firefly): ?>
            <article class="project-main-content">
                <section class="resume-section">
                    <h2><?php echo htmlspecialchars($bold_firefly['name']); ?>: The Automated Powerhouse</h2>
                    <p><?php echo htmlspecialchars($bold_firefly['details']['story'] ?? ''); ?></p>
                    
                    <?php if (!empty($bold_firefly['details']['features'])): ?>
                        <h3>Key Features:</h3>
                        <ul>
                            <?php foreach ($bold_firefly['details']['features'] as $feature): ?>
                                <li><?php echo htmlspecialchars($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </section>
            </article>
            <aside class="project-sidebar">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Bold Firefly Info</h3>
                        <?php if (!empty($bold_firefly['details']['tech_stack'])): ?>
                            <h4>Technology Stack</h4>
                            <ul class="project-tech-list">
                                <?php foreach ($bold_firefly['details']['tech_stack'] as $tech): ?>
                                    <li><span class="tag"><?php echo htmlspecialchars($tech); ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo htmlspecialchars($bold_firefly['url']); ?>" class="button button-outline-primary">Visit Live Site</a>
                    </div>
                </div>
            </aside>
            <?php endif; ?>

        </div>

        <hr style="margin: 3rem 0;">

        <div class="project-detail-layout">

            <!-- Glowing Galaxy Section -->
            <?php if ($glowing_galaxy): ?>
            <article class="project-main-content">
                <section class="resume-section">
                    <h2><?php echo htmlspecialchars($glowing_galaxy['name']); ?>: The Self-Managed Server</h2>
                    <p><?php echo htmlspecialchars($glowing_galaxy['details']['story'] ?? ''); ?></p>
                    
                    <?php if (!empty($glowing_galaxy['details']['features'])): ?>
                        <h3>Key Features:</h3>
                        <ul>
                            <?php foreach ($glowing_galaxy['details']['features'] as $feature): ?>
                                <li><?php echo htmlspecialchars($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </section>
            </article>
            <aside class="project-sidebar">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Glowing Galaxy Info</h3>
                        <?php if (!empty($glowing_galaxy['details']['tech_stack'])): ?>
                            <h4>Technology Stack</h4>
                            <ul class="project-tech-list">
                                <?php foreach ($glowing_galaxy['details']['tech_stack'] as $tech): ?>
                                    <li><span class="tag"><?php echo htmlspecialchars($tech); ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo htmlspecialchars($glowing_galaxy['url']); ?>" class="button button-outline-primary">Visit Live Site</a>
                    </div>
                </div>
            </aside>
            <?php endif; ?>

        </div>
    </div>
</main>

<?php
    // --- Include Footer ---
    include __DIR__ . '/../../includes/footer.php';
    include __DIR__ . '/../../includes/document-close.php';
?>
