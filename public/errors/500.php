<?php // --- /public/errors/500.php ---
    $page_title = "500 Internal Server Error";
    $body_class = "page-error";
    include __DIR__ . '/../includes/document-open.php';
    include __DIR__ . '/../includes/header.php';
?>
<main class="site-content" id="content">
    <div class="container">
        <header class="page-header">
            <h1>500 Internal Server Error</h1>
            <p class="lead">Sorry, something went wrong on our end. Please try again later.</p>
            <a href="/" class="button button-primary">Return to Homepage</a>
        </header>
    </div>
</main>
<?php
    include __DIR__ . '/../includes/footer.php';
    include __DIR__ . '/../includes/document-close.php';
?>
