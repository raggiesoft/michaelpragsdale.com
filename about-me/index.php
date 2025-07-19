<?php // --- about/index.php ---

    // --- Page-Specific Variables ---
    $page_title = "About Michael Ragsdale"; 
    $body_class = "page-about has-sidebar"; 
    $page_description = "Learn more about Michael Ragsdale's background, skills, resume, and how to get in touch.";

    // 1. Open the document
    include __DIR__ . '/../includes/document-open.php';

    // 2. Add the site header
    include __DIR__ . '/../includes/header.php';
?>

<div class="site-body-wrapper">

    <?php include __DIR__ . '/../includes/sidebars/sidebar-default.php'; ?>

    <main class="site-content" id="content">
        <div class="container"> 
            <header class="page-header">
                <h1>About Me</h1>
                <p class="lead">An overview of my professional background and resources for recruiters.</p>
            </header>

            <div class="row" style="--grid-gutter-y: var(--spacing-lg);">

                <div class="col-12 col-md-6">
                    <div class="card card-icon-link">
                        <div class="card-body">
                            <i class="fa-duotone fa-file-lines fa-3x card-icon"></i>
                            <h2 class="card-title h3">Interactive Résumé</h2>
                            <p class="card-text">View my full work history, education, and skills. Filter my experience to find what's most relevant to you.</p>
                            <a href="/resume/" class="button button-primary stretched-link">View Résumé</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card card-icon-link">
                        <div class="card-body">
                            <i class="fa-duotone fa-graduation-cap fa-3x card-icon"></i>
                            <h2 class="card-title h3">Education History</h2>
                            <p class="card-text">A summary of my academic background, degrees, and professional certifications in Information Technology and Leadership.</p>
                            <a href="/education/" class="button button-primary stretched-link">View Education</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card card-icon-link">
                        <div class="card-body">
                            <i class="fa-duotone fa-calculator fa-3x card-icon"></i>
                            <h2 class="card-title h3">Salary Checker</h2>
                            <p class="card-text">To ensure alignment, use this tool to see if an opportunity's compensation meets my requirements before reaching out.</p>
                            <a href="/about/salary/" class="button button-primary stretched-link">Use Salary Checker</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card card-icon-link">
                        <div class="card-body">
                            <i class="fa-duotone fa-calendar-days fa-3x card-icon"></i>
                            <h2 class="card-title h3">Schedule Interview</h2>
                            <p class="card-text">Ready to talk? Use my Calendly link to directly schedule a time that works for both of us. No back-and-forth emails required.</p>
                            <a href="/contact/" class="button button-primary stretched-link">Schedule Now</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</div>

<?php
    include __DIR__ . '/../includes/footer.php';
    include __DIR__ . '/../includes/document-close.php';
?>