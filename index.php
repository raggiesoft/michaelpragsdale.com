<?php // --- index.php (The New Home Page) ---

    // Page-Specific Variables
    $page_title = "Michael Ragsdale - Web Developer & Creator"; 
    $body_class = "page-home full-width"; // A class for the home page and one for the layout
    $page_description = "The official portfolio of Michael Ragsdale, showcasing RaggieSoft products, professional services, and web development expertise.";

    // 1. Open the document
    include __DIR__ . '/includes/document-open.php';

    // 2. Add the site header
    include __DIR__ . '/includes/header.php';
?>

<?php // 3. Main content area for the home page. Note there is NO sidebar. ?>
<main class="site-content" id="content">

    <section class="home-hero">
        <div class="container">
            <div class="hero-text">
                <h1 class="hero-title">Designing &amp; Developing<br>Modern Web Solutions.</h1>
                <p class="hero-subtitle">Hi, I'm Michael Ragsdale. I create powerful, user-friendly digital experiences under the RaggieSoft brand. Welcome to my portfolio.</p>
                <p class="hero-cta">
                    <a href="/employment/" class="button button-primary"><i class="fa-duotone fa-fw fa-briefcase" aria-hidden="true"></i>Employment</a>
                    <a href="https://www.linkedin.com/in/michael-ragsdale-raggiesoft/" class="button button-outline-light">Get In Touch</a>
                </p>
            </div>
        </div>
    </section>

    <section class="home-featured-work">
        <div class="container">
            <h2>Featured Work</h2>
            <?php // We will add content here later, like featured project cards ?>
            <p>I will be showing off samples of my work as I get the chance to polish and present them.</p>
        </div>
    </section>

</main>

<?php
    // 4. Add the site footer
    include __DIR__ . '/includes/footer.php';

    // 5. Close the document
    include __DIR__ . '/includes/document-close.php';
?>