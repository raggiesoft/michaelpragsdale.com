<?php // --- contact/index.php ---

    // --- Page-Specific Variables ---
    $page_title = "Contact Michael Ragsdale"; 
    $body_class = "page-contact has-sidebar"; 
    $page_script = "contact-flow"; // This is crucial for running the correct JavaScript
    $page_description = "A pre-qualification FAQ to help recruiters connect with Michael Ragsdale about relevant job opportunities.";

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
                <h1>Contact Me</h1>
                <p class="lead">To ensure we make the best use of everyone's time, please review the following information before scheduling an interview.</p>
            </header>

            <?php // This is the main container our JS looks for ?>
            <div id="contact-flow-app">
                
                <div class="accordion">
                    
                    <details class="accordion-item" id="accordion-location">
                        <summary class="accordion-header">What locations are you considering?</summary>
                        <div class="accordion-content">
                            <p>I am actively seeking opportunities that are either <strong>fully remote</strong> (for companies that hire residents of Virginia, USA) or <strong>in-office</strong> for the following cities only:</p>

                            <ul id="location-list-display">
                                </ul>
                        </div>
                    </details>

                    <details class="accordion-item" id="accordion-salary">
                        <summary class="accordion-header">What are your salary expectations?</summary>
                        <div class="accordion-content">
                            <p>My salary requirements are competitive for the region and depend on the role's responsibilities and the full compensation package. To see if we are aligned, please use this quick tool:</p>
                            
                            <?php // This is the placeholder where the salary form will be injected ?>
                            <div id="salary-checker-container" class="salary-checker-app" style="margin-top: 1.5rem;">
                                <div id="salary-result-container" style="margin-top: 1.5rem;" aria-live="polite"></div>
                            </div>
                        </div>
                    </details>

                    <details class="accordion-item" id="accordion-schedule">
                        <summary class="accordion-header">What's the best way to schedule an interview?</summary>
                        <div class="accordion-content">
                            <p>If the location and compensation for your opportunity align with the information above, I would be delighted to speak with you.</p>
                            <p>Please use my Calendly link to directly schedule a time that is convenient for both of us, eliminating any back-and-forth emails.</p>
                            <p style="margin-top: 1.5rem;">
                                <a href="https://calendly.com/michaelpragsdale/interview-with-michael-ragsdale/" class="button button-success"><i class="fa-duotone fa-calendar-days fa-fw"></i> Schedule an Interview Now</a>
                            </p>
                        </div>
                    </details>

                </div> <?php // End .accordion ?>

            </div> <?php // End #contact-flow-app ?>

        </div>
    </main>

</div> <?php // End of .site-body-wrapper ?>
<?php
    // 4. Add the site footer
    include __DIR__ . '/../includes/footer.php';

    // 5. Close the document
    include __DIR__ . '/../includes/document-close.php';
?>