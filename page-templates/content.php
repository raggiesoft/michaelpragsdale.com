<?php // --- template-content.php ---
      // Blueprint for standard content pages like About Me, Contact, Privacy Policy.

    // --- Page-Specific Variables ---
    $page_title = "Content Page Title - Michael Ragsdale"; 
    $body_class = "page-interior has-sidebar"; 
    $page_description = "A standard interior content page on Michael Ragsdale's portfolio.";

    // 1. Open the document
    include __DIR__ . '/includes/document-open.php';
    // 2. Add the site header
    include __DIR__ . '/includes/header.php';
?>
<div class="site-body-wrapper">
    <?php include __DIR__ . '/includes/sidebars/sidebar-default.php'; ?>
    <main class="site-content" id="content">
        <div class="container"> 
            <header class="page-header">
                <h1>Your Page Title Here</h1>
                <p class="lead">A brief, engaging subtitle for the page.</p>
            </header>
            <article class="content-area">
                <p>Your main page content, paragraphs, lists, etc., go here.</p>
            </article>
        </div>
    </main>
</div>
<?php
    // 4. Add the site footer & 5. Close the document
    include __DIR__ . '/includes/footer.php';
    include __DIR__ . '/includes/document-close.php';
?>