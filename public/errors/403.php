<?php // --- /public/errors/403.php ---
    $page_title = "403 Forbidden";
    $body_class = "page-error";
    include __DIR__ . '/../includes/document-open.php';
    include __DIR__ . '/../includes/header.php';
?>
<main class="site-content" id="content">
    <div class="container">
        <header class="page-header">
            <h1>403 Forbidden</h1>
            <p class="lead">Sorry, you don't have permission to access this page.</p>
            <a href="/" class="button button-primary">Return to Homepage</a>
        </header>
    </div>
</main>
<?php
    include __DIR__ . '/../includes/footer.php';
    include __DIR__ . '/../includes/document-close.php';
?>
