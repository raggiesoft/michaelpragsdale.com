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
    <meta name="description" property="og:description" content="In order to interview me, please answer a few questions about the job.." />
    <meta property="og:image" content="https://michaelpragsdale.com/assets/images/og/contact-me.png" />
    <meta property="og:title" content="Questionnaire - Michael Ragsdale&rsquo;s Portfolio" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://michaelpragsdale.com/samples/questionnaire/" />
	
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

    <title>AI - Michael Ragsdale's Portfolio</title>
</head>

<body>
	<a class="visually-hidden" href="#pageStart">Skip to Main Content</a>
    <header style="z-index: 999;">
        <?php 
				$rsNav = new TopNav("Sample Projects","https://michaelpragsdale.com/");
				$rsNav->writeButtonNav("Go Up", "/samples/", "fa-chevron-up", false, false);
				$rsNav->writeButtonNav("AI", "/samples/ai/", "fa-file", false, false);
                $rsNav->writeButtonNav("Document Conversion", "/samples/document-conversion/", "fa-file-code", false, false);
				$rsNav->writeButtonNav("MBA Self-Check Quiz", "/samples/mba-603/", "fa-file", false, false);
				$rsNav->writeButtonNav("Questionnaire", "index.php", "fa-file-code", true, false);
				$rsNav->writeNavBarClosing();
			?>
    </header>

    <section class="container-fluid">
        < class="row">
            <?php
				$rsSideBar = new SideNav("Michael Ragsdale&rsquo;s Samples", "fa-cogs",false, true);
				$rsSideBar->writeSideBarListOpening();
				$rsSideBar->writeSideBarListItem("Home", "https://michaelpragsdale.com/", "fa-home", false, true);
                $rsSideBar->writeSideBarListItem("Go Up", "/samples/", "fa-chevron-up", false, true);
				$rsSideBar->writeSideBarListItem("AI", "/samples/ai/", "fa-file", false, false, false, false, true);
				$rsSideBar->writeSideBarListItem("Document Conversion", "/samples/document-conversion/", "fa-file-code", false, false, false, false, true);
				$rsSideBar->writeSideBarListItem("MBA Self-Check Quiz", "/samples/mba-603/", "fa-file", false, false, false, false, true);
				$rsSideBar->writeSideBarListItem("Questionnaire", "index.php", "fa-file-code", true, true, false, false, true);
				$rsSideBar->writeSideBarListClosing();
				$rsSideBar->writeSideBarNavClosing();
			?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="pageStart">
				<article class="container">
					<h1><i class="fa-duotone fa-file me-2" aria-hidden="true" id="question-icon"></i>
					Questionnaire</h1>
					<p>The recruiter questionnaire uses Calendly to allow me to have a recruiter answer a few basic questions about a job, to see if I am interested in discussing it further. In the future, I intend to use the Calendly API to have the questions appear on my website and only advance if they are answered to my satisfaction.</p>
					<p class="text-center"><a href="/hire-me/schedule-interview/" class="btn btn-primary btn-lg"><i class="fa-duotone fa-envelope me-2" aria-hidden="true"></i>View Questionnaire</a></p>
				</article>
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