<?php // --- /public/errors/503.php ---
    $page_title = "503 Service Unavailable";
    $body_class = "page-error";
    include __DIR__ . '/../includes/document-open.php';
    include __DIR__ . '/../includes/header.php';
?>
<main class="site-content" id="content">
    <div class="container">
        <header class="page-header">
            <h1>503 Service Unavailable</h1>
            <p class="lead">The server is temporarily down for maintenance. Please check back soon.</p>
            <a href="/" class="button button-primary">Return to Homepage</a>
        </header>
    </div>
</main>
<?php
    include __DIR__ . '/../includes/footer.php';
    include __DIR__ . '/../includes/document-close.php';
?>
