<?php
	include("../../../../includes/utilities.php");
	include("../../../../includes/navigator.php");
	include("../../../../includes/footer.php");
	require_once("../../../../includes/privatedaddy.php");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" property="og:description" content="Samples of what I can do." />
    <meta property="og:image" content="https://michaelpragsdale.com/assets/images/og/contact-me.png" />
    <meta property="og:title" content="School Work - Samples - Michael Ragsdale&rsquo;s Portfolio" />
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

    <title>School - Michael Ragsdale's Portfolio</title>
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
					$rsSideBar = new SideNav("ODU", "fa-school",false, true);
					$rsSideBar->writeSideBarListOpening();
					$rsSideBar->writeSideBarListItem("Home", "/", "fa-home", false, true);
                    $rsSideBar->writeSideBarListItem("Up", "../index.php", "fa-chevron-up", false, true);
					$rsSideBar->writeSideBarListItem("Summer 2024", "#summer2024", "fa-school");
                    
					$rsSideBar->writeSideBarListClosing();
					$rsSideBar->writeSideBarNavClosing();
					
			?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="pageStart">
				<article class="container">
					<h1><i class="fa-duotone fa-folder-gear me-2" aria-hidden="true"></i>ODU School Work</h1>
					<p>Welcome to the assignments page for my Old Dominion University classes. This will be where I post homework assignments that I&rsquo;ve turned in.</p>
					<!--Section: Assignment Packages-->
					<section class="text-center">
                        <h2 id="summer2024">Summer 2025</h2>
						<section class="row">
							<!-- Card 1 of 3 -->
							<section class="col-lg-4 col-md-12 mb-4">
								<section class="card">
									<section class="card-body">
										<h3 class="card-title">IDS 300W</h3>
										<p class="card-text">This was a writing intensive class.</p>
										<a href="ids300w/" class="btn btn-primary"><i class="fa-duotone fa-binoculars me-2" aria-hidden="true"></i>View Collection</a>
									</section>
								</section>
							</section>
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
	
</body>

</html>