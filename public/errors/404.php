<?php // --- /public/errors/404.php ---
    $page_title = "404 Not Found";
    $body_class = "page-error";
    include __DIR__ . '/../includes/document-open.php';
    include __DIR__ . '/../includes/header.php';
?>
<main class="site-content" id="content">
    <div class="container">
        <header class="page-header">
            <h1>404 Not Found</h1>
            <p class="lead">Sorry, the page you were looking for could not be found.</p>
            <a href="/" class="button button-primary">Return to Homepage</a>
        </header>
    </div>
</main>
<?php
    include __DIR__ . '/../includes/footer.php';
    include __DIR__ . '/../includes/document-close.php';
?>
