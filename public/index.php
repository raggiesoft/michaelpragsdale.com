<?php // --- /public/index.php ---

    // --- Page-Specific Variables ---
    $page_title = "Michael Ragsdale - Web Developer Portfolio"; 
    $body_class = "page-home";
    $page_description = "The professional portfolio of Michael Ragsdale, a web developer specializing in PHP, JavaScript, and modern web technologies.";

    // --- Data Loading ---
    // Load all projects and filter for the featured ones
    $all_projects = json_decode(file_get_contents(__DIR__ . '/assets/json/projects.json'), true) ?? [];
    $featured_projects = array_filter($all_projects, function($project) {
        return !empty($project['is_featured']);
    });

    // Load employment history and get the most recent job
    $employment_history = json_decode(file_get_contents(__DIR__ . '/assets/json/employment.json'), true) ?? [];
    $latest_job = !empty($employment_history) ? $employment_history[0] : null;

    // --- Include Header ---
    include __DIR__ . '/includes/document-open.php';
    include __DIR__ . '/includes/header.php';
?>

<main class="site-content" id="content">

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Welcome to My Portfolio</h1>
                <p class="lead hero-subtitle">I'm Michael Ragsdale, a web developer passionate about building elegant, accessible, and data-driven solutions.</p>
                <div class="hero-cta">
                    <a href="/projects/" class="button button-primary button-lg">View My Work</a>
                    <a href="/resume/" class="button button-outline-secondary button-lg">View My Resume</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Me Summary -->
    <section class="content-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 text-center">
                    <img src="/assets/images/michael-ragsdale-profile.jpg" alt="A profile photo of Michael Ragsdale" class="profile-image">
                </div>
                <div class="col-md-8">
                    <h2>About Me</h2>
                    <p>A versatile professional with a background in team leadership and customer service, now building on a practical foundation in web development, server administration, and technical problem-solving. Eager to apply a unique blend of strong communication skills and technical aptitude to an entry-level IT or customer service role.</p>
                    <a href="/about-me/" class="button button-outline-primary">Learn More About Me</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects -->
    <?php if (!empty($featured_projects)): ?>
    <section class="content-section bg-light">
        <div class="container">
            <header class="section-header text-center">
                <h2>Featured Projects</h2>
                <p class="lead">Here are a few projects I'm particularly proud of. See the rest in my projects section.</p>
            </header>

            <div class="auto-grid">
                <?php foreach ($featured_projects as $project): ?>
                    <div class="card clickable-card card-featured" data-link="/projects/detail.php?id=<?php echo htmlspecialchars($project['id']); ?>" role="link" tabindex="0">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo htmlspecialchars($project['name']); ?></h3>
                            <p class="card-text"><?php echo htmlspecialchars($project['short_description'] ?? ''); ?></p>
                            <?php if (!empty($project['tech_stack'])): ?>
                                <ul class="project-tech-list">
                                    <?php foreach ($project['tech_stack'] as $tech): ?>
                                        <li><span class="tag"><?php echo htmlspecialchars($tech); ?></span></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <span class="button-text-link">View Details <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Latest Experience -->
    <?php if ($latest_job): ?>
    <section class="content-section">
        <div class="container">
            <header class="section-header text-center">
                <h2>Latest Experience</h2>
                <p class="lead">My most recent role, combining technical skills with customer-facing responsibilities.</p>
            </header>
            <div class="card">
                <div class="card-body">
                    <div class="history-item__header">
                        <?php if (!empty($latest_job['logo'])): ?>
                            <img src="/<?php echo htmlspecialchars($latest_job['logo']); ?>" alt="<?php echo htmlspecialchars($latest_job['company'] ?? ''); ?> logo" class="history-item__logo">
                        <?php endif; ?>
                        <div class="history-item__header-text">
                            <h3 class="history-item__title"><?php echo htmlspecialchars($latest_job['company'] ?? 'N/A'); ?></h3>
                            <?php if (!empty($latest_job['roles'][0]['title'])): ?>
                                <h4 class="history-item__subtitle"><?php echo htmlspecialchars($latest_job['roles'][0]['title']); ?></h4>
                            <?php endif; ?>
                            <?php // Use the correct 'role-period' class to match the resume page styling ?>
                            <?php if (!empty($latest_job['roles'][0]['period'])): ?>
                                <div class="role-period"><?php echo htmlspecialchars($latest_job['roles'][0]['period']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php // Use the 'it' description for the homepage ?>
                    <?php if (!empty($latest_job['roles'][0]['description']['it']) && is_array($latest_job['roles'][0]['description']['it'])): ?>
                        <ul class="role-description">
                            <?php foreach ($latest_job['roles'][0]['description']['it'] as $bullet_point): ?>
                                <li><?php echo htmlspecialchars($bullet_point); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="card-footer">
                    <a href="/resume/" class="button button-outline-primary">See Full Work History</a>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

</main>

<?php
    // --- Include Footer ---
    include __DIR__ . '/includes/footer.php';
    include __DIR__ . '/includes/document-close.php';
?>
