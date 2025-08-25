<?php
	include("../../../../../includes/utilities.php");
	include("../../../../../includes/navigator.php");
	include("../../../../../includes/footer.php");
	require_once("../../../../../includes/privatedaddy.php");
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

    <title>ITN 171 School Work - Michael Ragsdale's Portfolio</title>
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
					$rsSideBar = new SideNav("ITN 171", "fa-school",false, true);
					$rsSideBar->writeSideBarListOpening();
					$rsSideBar->writeSideBarListItem("Home", "index.php", "fa-home", false, true);
					$rsSideBar->writeSideBarListItem("Terminal Cheat Sheet", "terminal-cheat-sheet.php", "fa-clipboard-list-check", true);
					
					$rsSideBar->writeSideBarListClosing();
					$rsSideBar->writeSideBarNavClosing();
					
			?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="pageStart">
				<article class="container">
					<h1><i class="fa-duotone fa-clipboard-list-check me-2" aria-hidden="true"></i>Terminal Cheat Sheet</h1>
					<p>Cheat Sheet of Terminal Commands I&rsquo;m using in my Unix class. This is meant to be turned in as a grade, and will be expanded upon over the course of the semester.</p>
					<p><strong>Last updated:</strong> 09/17/2024.</p>
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Command</th>
                                <th scope="col">Description</th>
                                <th scope="col">Notes</th>
                            </tr>
                        </thead>
                        <tbody>
							<tr id="cd">
                                <th scope="row" class="border-bottom-0">cd</th>
                                <td>Change Directory</td>
                                <td>Works just as it does in MS-DOS.</td>
                            </tr>
							<tr id="cp">
                                <th scope="row">cp</th>
                                <td>Copy</td>
                                <td>Copies an item from one location to another</td>
                            </tr>
							<tr id="less">
								<th scope="row">less</th>
								<td>Less</td>
								<td>Less is More. Used to make it easy to scroll up or down when viewing a long output. See also <a href="#more">more</a>.</td>
							</tr>
							<tr id="more">
								<th scope="row">more</th>
								<td>More</td>
								<td>Lets page down one screen at a time over a long output. See also <a href=#less">less</a></td>
							</tr>
							<tr id="pwd">
								<th scope="row">pwd</th>
								<td>Print Working Directory</td>
								<td>Does what is on the tin. Tells you where in the directory structure you are.</td>
							</tr>
							<tr id="vim">
								<th scope="row">vim</th>
								<td>Vi IMproved (Text Editor)</td>
								<td>Lets you edit plain text documents. There is a bit of a learning curve coming from Notepad++ or VS Code</td>
							</tr>
                        </tbody>
                    </table>
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
	
	<!-- Modal Dialogs for holding info on *nix commands -->
	<section class="modal" tabindex="-1" id="tcs-modal">
		<section class="modal-dialog" id="tcs-modal-dialog">
			<section class="modal-content" id="tcs-modal-content">
				<section class="modal-header" id="tcs-modal-header">
					<h2 class="h5" id="tcs-modal-header-text"></h2>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="tcs-modal-header-button-close"></button>
				</section>
				<section class="modal-body" id="tcs-modal-body">

				</section>
				<section class="modal-footer" id="tcs-modal-footer">
					
				</section>
			</section>
		</section>
	</section>
</body>

</html>