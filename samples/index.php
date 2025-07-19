<?php
	include("../../includes/utilities.php");
	include("../../includes/navigator.php");
	include("../../includes/footer.php");
	require_once("../../includes/privatedaddy.php");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" property="og:description" content="Samples of what I can do." />
    <meta property="og:image" content="https://michaelpragsdale.com/assets/images/og/contact-me.png" />
    <meta property="og:title" content="Samples - Michael Ragsdale&rsquo;s Portfolio" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://michaelpragsdale.com/samples/" />
	
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

    <title>Samples - Michael Ragsdale's Portfolio</title>
</head>


<body>
	<a href="#pageStart" class="visually-hidden">Skip to Main Content</a>
    <header style="z-index: 999;">
        <?php 
			$rsNav = new TopNav("Michael Ragsdale","/");
			$rsNav->writeButtonNav("About Me", "/about-me/", "fa-user", false, false);
			$rsNav->writeButtonNav("Contact Me", "/hire-me/", "fa-envelope", false, false);
			$rsNav->writeButtonNav("Education","/education/", "fa-school", false, false);
			$rsNav->writeButtonNav("Employment", "/employment/", "fa-briefcase", false, false);
			$rsNav->writeButtonNav("Location", "/location/", "fa-map-location-dot", false, false);
			$rsNav->writeButtonNav("Rate &amp; Salary", "/hire-me/salary/", "fa-money-bill-trend-up", false, false);
			$rsNav->writeButtonNav("Samples", "/samples/", "fa-folder-gear", true, false);
			$rsNav->writeButtonNav("Skills", "/skills/", "fa-list-check", false, false);
			
			$rsNav->writeNavBarClosing();
		?>
    </header>

    <section class="container-fluid">
        <section class="row">
            <?php
					$rsSideBar = new SideNav("Michael Ragsdale&rsquo;s Portfolio", "fa-folder-user",false, true);
					$rsSideBar->writeSideBarListOpening();
					$rsSideBar->writeSideBarListItem("Home", "/", "fa-home", false, true);
					$rsSideBar->writeSideBarListItem("About Me", "/about-me/", "fa-user", false);
					$rsSideBar->writeSideBarListItem("Contact Me", "/hire-me/", "fa-envelope");
					$rsSideBar->writeSideBarListItem("Education", "/education/", "fa-school", false, false);
					$rsSideBar->writeSideBarListItem("Employment", "/employment/", "fa-briefcase", false, false);
                    $rsSideBar->writeSideBarListItem("Location", "/location/", "fa-map-location-dot", false, false);
					$rsSideBar->writeSideBarListItem("Rate &amp; Salary", "/hire-me/salary/", "fa-money-bill-trend-up", false, false);
					$rsSideBar->writeSideBarListItem("Samples", "/samples/", "fa-folder-gear", true, false);
					$rsSideBar->writeSideBarListItem("Skills", "/skills/", "fa-list-check", false, false);
					
					
					$rsSideBar->writeSideBarListClosing();
					$rsSideBar->writeSideBarNavClosing();
					
			?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="pageStart">
				<article class="container">
					<h1><i class="fa-duotone fa-folder-gear me-2" aria-hidden="true"></i>Sample Work</h1>
					<p>As a demonstration of my knowledge of work, these samples are available for you to view and takes notes from. <strong>I do not participate in any skills challenge or tests of any kind</strong> unless I am compensated for my time. I refuse to work <q>off the clock.</q></p>
					<section class="row">
						<section class="col-md mb-2">
							<wa-card class="mpr-wa-info" id="source-agreement">
								<p>By accessing any source code I make available as a sample, you agree that it is provided as a <em>reference of my skill set</em> and my not be used in any, shape, or form in one of your (or your company&rsquo;s) projects.</p>
								<p>In order to view my sample projects, you <strong>must</strong> accept the terms of this agreement.</p>
								<wa-button class="btn-primary" id="code-agreement-button"><i class="fa-duotone fa-question-circle" aria-hidden="true" slot="prefix"></i>Yes, I Agree</wa-button>
							</wa-card>
						</section>
						<section class="col-md">
							<ul class="list-group mb-3 pb-3">
								<li class="list-group-item list-group-item-primary lead"><i class="fa-duotone fa-info-circle me-2" aria-hidden="true"></i>Legend<wa-visually-hidden> (these will be announced by your screen reader as well)</wa-visually-hidden></li>
								<li class="list-group-item list-group-item-code-available"><i class="fa-duotone fa-file-code me-2" title="Source Code Available" aria-hidden="true"></i>Source Code Available</li>
								<li class="list-group-item list-group-item-code-not-available"><i class="fa-duotone fa-file me-2" title="Source Code Not Available" aria-hidden="true"></i>Source Code Not Available</li>
							</ul>
						</section>
					</section>
					<section class="mpr-sampler-platter m-3 p-3 rounded" id="sampler">
						<section class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
							<!-- AI -->
							<wa-card with-header with-footer class="mpr-wa-sampler-source-no" id="sampler-ai">
								<section slot="header">
									<h2><i class="fa-duotone fa-file me-2" title="Source Code Not Available" aria-label="Source Code Available for"></i>Artificial Intelligence</h2>
								</section>
								<p>I am starting to dive into the world of AI. Using <em>Microsoft Designer</em>, I am creating characters.</p>
								<p class="text-center fw-bold">Source Code Not Available</p>
								<section slot="footer">
									<wa-button href="/samples/ai/" class="btn-primary"><i class="fa-duotone fa-binoculars" slot="prefix" aria-hidden="true"></i>View Sample</wa-button>
								</section>
							</wa-card>
							
							<!-- HRT Winter Weather Alert -->
							<wa-card with-header with-footer class="mpr-wa-sampler-source-yes" id="sampler-document-conversion">
								<section slot="header">
									<h2><i class="fa-duotone fa-file-code me-2" title="Source Code Available" aria-label="Source Code Available for"></i>Document Conversion</h2>
								</section>
								<p>This takes an image of a table and converts it to a proper table that is fully Section 508 &amp; WCAG compliant.</p>
								<section slot="footer">
									<wa-button href="/samples/document-conversion/" class="btn-primary"><i class="fa-duotone fa-binoculars" slot="prefix" aria-hidden="true"></i>View Sample</wa-button>
								</section>
							</wa-card>

							<!-- MBA 603 (no source code) -->
							<wa-card with-header with-footer class="mpr-wa-sampler-source-no" id="sampler-document-conversion">
								<section slot="header">
									<h2><i class="fa-duotone fa-file me-2" title="Source Code Not Available" aria-label="Source Code Not Available for"></i>MBA Self-Check Quiz</h2>
								</section>
								<p>Took a self-check quiz for Graduate level MBA students and made it fully WCAG compliant</p>
								<p class="text-center fw-bold">Source Code Not Available</p>
								<section slot="footer">
									<wa-button class="btn-primary" href="/samples/mba-603/"><i class="fa-duotone fa-binoculars" slot="prefix" aria-hidden="true"></i>View Sample</wa-button>
								</section>
							</wa-card>

							<!-- Questionnaire -->
							<wa-card with-header with-footer class="mpr-wa-sampler-source-no" id="sampler-document-conversion">
								<section slot="header">
									<h2><i class="fa-duotone fa-file-code me-2" title="Source Code Available" aria-label="Source Code Available for"></i>Questionnaire</h2>
								</section>
								<p>The amount of emails I get where the job doesn&rsquo;t match my criteria can be overwhelming. This questionnaire attempts to weed out the non-starters (for example, I&rsquo;m not ready to relocate).</p>
								<p class="text-center fw-bold">Source Code Not Available</p>
								<section slot="footer">
									<wa-button href="/samples/questionnaire/" class="btn-primary"><i class="fa-duotone fa-binoculars" slot="prefix" aria-hidden="true"></i>View Sample</wa-button>
								</section>
							</wa-card>

							<!-- RaggieSoft Book Reader -->
							<wa-card with-header with-footer class="mpr-wa-sampler-source-yes" id="sampler-raggiesoft-book-reader">
								<section slot="header">
									<h2><i class="fa-duotone fa-file-code me-2" title="Source Code Available" aria-label="Source Code Available for"></i>Raggiesoft Book Reader</h2>
								</section>
								<p>RaggieSoft Book Reader is my attempt to combine multiple programming languages into one piece of software.</p>
								<section slot="footer">
									<wa-button class="btn-primary" disabled><i class="fa-duotone fa-binoculars" slot="prefix" aria-hidden="true"></i>Coming Soon!</wa-button>
								</section>
							</wa-card>

							<!-- School Work (no source code) -->
							<wa-card with-header with-footer class="mpr-wa-sampler-source-no" id="sampler-school-worl">
								<section slot="header">
									<h2><i class="fa-duotone fa-file me-2" title="Source Code Not Available" aria-label="Source Code Not Available for"></i>School Work</h2>
								</section>
								<p>I am documenting the assignments I turn in for school work that is related to web development</p>
								<p class="text-center fw-bold">Source Code Not Available</p>
								<section slot="footer">
									<wa-button class="btn-primary" href="/samples/school-work/"><i class="fa-duotone fa-binoculars" slot="prefix" aria-hidden="true"></i>View Sample</wa-button>
								</section>
							</wa-card>

						</section>
					</section>
				</article>
            </main>
        </section>
    </section>
    <?php writeFooter(true); ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        
	<!-- Activate the Web Awesome Alpha components -->
	<script type="module" src="https://early.webawesome.com/webawesome@3.0.0-alpha.11/dist/webawesome.loader.js" data-fa-kit-code="ec060982d4"></script>

	<!-- RaggieSoft Common Functionality -->
	<script src="/assets/js/mpr.js"></script>
	<script language="javascript">
		let samplerPlatter = document.getElementById("sampler");
		let samplerAgreeButton = document.getElementById("code-agreement-button");
		let samplerCard = document.getElementById("source-agreement");
		samplerPlatter.style.display = "none";
		samplerAgreeButton.addEventListener("click", () => showSamples());

		function showSamples()
		{
			samplerCard.classList.remove("mpr-wa-info");
			samplerCard.classList.add("mpr-wa-success");
			samplerPlatter.style.display = "block";
			samplerCard.innerHTML = "<p>By accessing any source code I make available as a sample, you agree that it is provided as a <em>reference of my skill set</em> and my not be used in any, shape, or form in one of your (or your company&rsquo;s) projects.</p><p class=\"lead\"><i class=\"fa-duotone fa-check-circle me-2\" aria-hidden=\"true\"></i>Agreement Acknowledged</p>";
		}
	</script>
	
</body>

</html>