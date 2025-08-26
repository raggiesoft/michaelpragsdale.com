<?php // --- /public/accessibility/index.php ---

    // --- Page-Specific Variables ---
    $page_title = "Accessibility Statement - Michael Ragsdale"; 
    $body_class = "page-accessibility has-sidebar";
    $page_description = "An overview of the accessibility standards and practices for michaelpragsdale.com, including WCAG and Section 508 compliance.";

    // --- Include Header ---
    include __DIR__ . '/../includes/document-open.php';
    include __DIR__ . '/../includes/header.php';
?>

<div class="site-body-wrapper">
    <?php include __DIR__ . '/../includes/sidebars/sidebar-default.php'; ?>

    <main class="site-content" id="content">
        <div class="container"> 
            <header class="page-header">
                <h1>Accessibility Statement</h1>
                <p class="lead">My commitment to making this website accessible to everyone.</p>
            </header>

            <article class="content-section">
                <h2>A Commitment to Inclusivity</h2>
                <p>I believe the web should be accessible to all, regardless of ability or the technology they use. This portfolio is a personal project, and one of my core goals is to ensure it provides a welcoming and functional experience for every visitor. I am committed to striving for compliance with modern accessibility standards and continuously improving the user experience for everyone.</p>

                <h2>Standards and Goals</h2>
                <p>My goal is for this website to meet and, where possible, exceed the standards set by the <strong>Web Content Accessibility Guidelines (WCAG) 2.1</strong>. I am actively working to ensure the site is compliant with:</p>
                <ul>
                    <li><strong>WCAG 2.1 Level AA:</strong> This is my primary target, as it is the most common standard for web accessibility worldwide.</li>
                    <li><strong>WCAG 2.1 Level AAA:</strong> Where feasible, I aim to incorporate Level AAA success criteria, particularly in areas like color contrast and clarity.</li>
                    <li><strong>Section 508:</strong> As a U.S.-based developer, I also strive to ensure the site is compliant with the standards of Section 508 of the Rehabilitation Act.</li>
                </ul>

                <h2>An Ongoing Effort & Specific Measures</h2>
                <p>I am not perfect, and this website is a living project. Accessibility is not a one-time checklist but an ongoing process of learning and improvement. In addition to general best practices like using semantic HTML, I have implemented several specific features to improve the user experience:</p>
                <ul>
                    <li>
                        <strong>Respect for User Preferences:</strong>
                        <ul>
                            <li><strong>Light & Dark Mode:</strong> The website will automatically respect your device's light or dark mode settings to provide a more comfortable viewing experience. (This is done using the `prefers-color-scheme` CSS media query).</li>
                            <li><strong>Reduced Motion:</strong> If you've enabled "reduce motion" settings on your device (often used to prevent motion sickness), decorative animations like the moving stars or fireflies on project pages will be automatically disabled. (This is done using the `prefers-reduced-motion` media query).</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Enhanced Keyboard Navigation:</strong>
                        <ul>
                            <li><strong>Skip to Content Link:</strong> Keyboard users can press the `Tab` key upon loading a page to immediately reveal a "Skip to Content" link. This allows you to bypass the entire navigation menu and jump directly to the main content of the page.</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Screen Reader Support:</strong>
                        <ul>
                            <li><strong>Contextual Text:</strong> For icons or buttons where the meaning is purely visual, I have included hidden text that is only read aloud by screen readers to provide necessary context (using `visually-hidden` CSS classes).</li>
                            <li><strong>Hiding Decorative Images:</strong> To reduce unnecessary noise for screen reader users, images that are purely for decoration and add no informational value are hidden from assistive technology (using an empty `alt=""` attribute or `aria-hidden="true"`).</li>
                        </ul>
                    </li>
                </ul>
                <p>If you encounter any accessibility barriers or have suggestions on how I can improve the experience, I genuinely want to hear from you. Your feedback is an invaluable part of this process.</p>

                <h2>Feedback and Contact</h2>
                <p>Should you have any issues or questions regarding the accessibility of this site, please do not hesitate to reach out. You can find my contact information and schedule a time to speak with me directly via my <a href="/contact/">contact page</a>.</p>

            </article>
        </div>
    </main>
</div>

<?php
    // --- Include Footer ---
    include __DIR__ . '/../includes/footer.php';
    include __DIR__ . '/../includes/document-close.php';
?>
