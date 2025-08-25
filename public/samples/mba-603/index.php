<?php
	include("../../../includes/utilities.php");
	include("../../../includes/navigator.php");
	include("../../../includes/footer.php");
	require_once("../../../includes/privatedaddy.php");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" property="og:description" content="Accessibility conversion for a JavaScript App." />
    <meta property="og:image" content="https://michaelpragsdale.com/assets/images/og/contact-me.png" />
    <meta property="og:title" content="MBA 603 - Michael Ragsdale&rsquo;s Portfolio" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://michaelpragsdale.com/samples/mba-603/" />
	
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/logo/logo-light.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.min.css" />
    
	<!-- Bootstrap for the Layout Grid -->
        
    <!-- Start with Dark Mode ... -->
    <link rel="stylesheet" href="/assets/css/bootstrap/bootstrap.dark.min.css" media="(prefers-color-scheme: dark)" />
    <!-- ... and then the primary CSS last for a fallback on very old browsers that don't support media filtering -->
    <link rel="stylesheet" href="/assets/css/bootstrap/bootstrap.light.min.css" media="(prefers-color-scheme: no-preference), (prefers-color-scheme: light)" />

	<!-- Website Colors -->
	<!-- Start off with the master list of color swatches -->
	<link rel="stylesheet" href="/assets/css/mpr-color-swatches.css" />

	<!-- Colors for my Brand that should never change -->
	<link rel="stylesheet" href="/assets/css/mpr-color-brand.css" />

	<!-- Theme Colors -->
	<link rel="stylesheet" href="/assets/css/mpr-themes/raggiesoft-blue.css" />

	<!-- Layout that supplements Bootstrap -->
    <link rel="stylesheet" href="/assets/css/mpr.css" />

	<!-- Font Awesome Pro -->
	<script src="https://kit.fontawesome.com/ec060982d4.js" crossorigin="anonymous"></script>

	<!-- Web Awesome Alpha -->
	<link rel="stylesheet" href="https://early.webawesome.com/webawesome@3.0.0-alpha.11/dist/styles/themes/default.css" />

	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Permanent+Marker" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton" />

    <title>MBA 603 - Michael Ragsdale's Portfolio</title>
</head>

<body>
	<a class="visually-hidden" href="#pageStart">Skip to Main Content</a>
    <header style="z-index: 999;">
        <?php 
				$rsNav = new TopNav("Sample Projects","https://michaelpragsdale.com/");
				$rsNav->writeButtonNav("Go Up", "../index.php", "fa-chevron-up", false, false);
				$rsNav->writeButtonNav("AI", "/samples/ai/", "fa-file", false, false);
                $rsNav->writeButtonNav("Document Conversion", "/samples/document-conversion/", "fa-file-code", false, false);
                $rsNav->writeButtonNav("MBA Self-Check Quiz", "index.php", "fa-file", true, false);
				$rsNav->writeButtonNav("Questionnaire", "/samples/questionnaire/", "fa-file-code", false, false);
				$rsNav->writeNavBarClosing();
			?>
    </header>

    <section class="container-fluid">
        <section class="row">
            <?php
				$rsSideBar = new SideNav("Michael Ragsdale&rsquo;s Samples", "fa-cogs",false, true);
				$rsSideBar->writeSideBarListOpening();
				$rsSideBar->writeSideBarListItem("Home", "https://michaelpragsdale.com/", "fa-home", false, true);
				$rsSideBar->writeSideBarListItem("Go Up", "../index.php", "fa-chevron-up", false, true);
				$rsSideBar->writeSideBarListItem("AI", "/samples/ai/", "fa-file", false, false, false, false, true);
				$rsSideBar->writeSideBarListItem("Document Conversion", "/samples/document-conversion/", "fa-file-code", false, false, false, false, true);
                $rsSideBar->writeSideBarListItem("MBA Self-Check Quiz", "index.php", "fa-file", true, false, false, false, true);
				$rsSideBar->writeSideBarListItem("Questionnaire", "/samples/questionnaire/", "fa-file-code", false, true, false, false, true);
				$rsSideBar->writeSideBarListClosing();
				$rsSideBar->writeSideBarNavClosing();
			?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="pageStart">
				<article class="container">
					<h1><i class="fa-duotone fa-file me-2" aria-hidden="true" id="question-icon"></i>
					MBA Self-Check Quiz</h1>
					<p class="lead">One of the earliest WCAG and Section 508 accomplishments that I am very proud of is taking a self-check quiz for Graduate Level MBA students and making it accessible.</p>
                    <p>I changed it from simply showing the answer in <code title="red #ff0000;">#ff0000;</code> to a variant of red and green that work great for someone with visual disabilities. In addition, the student has to make an effort before the answer is revealed to be right or wrong. The wrong answer will be highlighted in a color deficiency compliant red, will have an icon, and screen readers will announce that the answer is wrong. The same goes if the answer is correct: a color deficiency compliant green, an icon, and the screen reader will announce that the answer is correct.</p>
                    <p>These were tested using Firefox Developer&rsquo;s <a href="https://firefox-source-docs.mozilla.org/devtools-user/accessibility_inspector/simulation/" target="_blank">Color Vision Simulation<i class="fa-duotone fa-external-link-alt ms-1" aria-label="Link opens in New Tab or Window"></i></a>.</p>
				</article>
			</section>
		</main>
		
        </section>
    </section>
	<?php writeFooter(true); ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="/assets/js/rs-custom.min.js"></script>
        
	<!-- Activate the Web Awesome Alpha components -->
	<script type="module" src="https://early.webawesome.com/webawesome@3.0.0-alpha.11/dist/webawesome.loader.js" data-fa-kit-code="ec060982d4"></script>

	<!-- RaggieSoft Common Functionality -->
	<script src="/assets/js/mpr.js"></script>
	
	
</body>

</html>