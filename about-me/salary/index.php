<?php // --- about-me/salary/index.php ---

    // --- Page-Specific Variables ---
    $page_title = "Salary Checker - Michael Ragsdale"; 
    $body_class = "page-salary-checker has-sidebar"; 
    $page_description = "A simple tool for recruiters to pre-qualify salary ranges for job opportunities.";

    // This is the key: Tell the template to load our Frutiger Aero stylesheet.
    // The name 'frutiger-aero' matches the compiled CSS file name.
    $supplemental_css_files = ['frutiger-aero'];

    // 1. Open the document
    // We now go up two directories ('../../') to find the /includes/ folder
    include __DIR__ . '/../../includes/document-open.php';

    // 2. Add the site header
    include __DIR__ . '/../../includes/header.php';
?>

<?php // 3. Assemble the main body content (sidebar + main content area) ?>
<div class="site-body-wrapper">

    <?php 
        include __DIR__ . '/../../includes/sidebars/sidebar-default.php'; 
    ?>

    <main class="site-content" id="content">
        <div class="container"> 
            
            <header class="page-header">
                <h1>Salary Checker</h1>
                <p class="lead">To ensure we're aligned, please use this tool to see if an opportunity's compensation meets my minimum requirements before reaching out.</p>
            </header>

            <div class="salary-checker-app">
                <form id="salary-checker-form" novalidate>
                    
                    <div class="form-row">
                        <div class="form-group" style="flex-grow: 2;">
                            <label for="salary-low">Salary Range (Low End)</label>
                            <input type="number" id="salary-low" inputmode="decimal" placeholder="e.g., 75000" required>
                        </div>
                        <div class="form-group" style="flex-grow: 2;">
                            <label for="salary-high">Salary Range (High End)</label>
                            <input type="number" id="salary-high" inputmode="decimal" placeholder="e.g., 85000">
                        </div>
                        <div class="form-group" style="flex-grow: 1;">
                            <label for="salary-type">Rate</label>
                            <select id="salary-type" class="form-control">
                                <option value="yearly" selected>Per Year</option>
                                <option value="hourly">Per Hour</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="button button-primary">
                        <i class="fa-duotone fa-calculator fa-fw"></i> Check Salary
                    </button>

                </form>

                <hr>

                <div id="salary-result-container" class="salary-result" aria-live="polite">
                    <?php // JavaScript will place alert messages here ?>
                </div>
            </div>

        </div>
    </main>

</div> <?php // End of .site-body-wrapper ?>

<?php
    // 4. Add the site footer
    include __DIR__ . '/../../includes/footer.php';

    // 5. Close the document
    include __DIR__ . '/../../includes/document-close.php';
?>