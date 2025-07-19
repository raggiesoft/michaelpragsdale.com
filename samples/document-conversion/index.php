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
    <meta name="description" property="og:description" content="Section 508 and WCAG Conversion Sample" />
    <meta property="og:image" content="https://michaelpragsdale.com/assets/images/og/contact-me.png" />
    <meta property="og:title" content="Document Conversion - Michael Ragsdale&rsquo;s Portfolio" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://michaelpragsdale.com/samples/document-conversion/" />
	
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

    <title>Document Conversion - Michael Ragsdale's Portfolio</title>
</head>

<body>
	<a class="visually-hidden" href="#pageStart">Skip to Main Content</a>
    <header style="z-index: 999;">
        <?php 
				$rsNav = new TopNav("Sample Projects","https://michaelpragsdale.com/");
				$rsNav->writeButtonNav("Go Up", "../index.php", "fa-chevron-up", false, false);
				$rsNav->writeButtonNav("AI", "/samples/ai/", "fa-file", false, false);
                $rsNav->writeButtonNav("Document Conversion", "index.php", "fa-file-code", true, false);
				$rsNav->writeButtonNav("MBA Self-Check Quiz", "/samples/mba-603/", "fa-file", false, false);
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
				$rsSideBar->writeSideBarListItem("Document Conversion", "index.php", "fa-file-code", true, false, false, false, true);
				$rsSideBar->writeSideBarListItem("MBA Self-Check Quiz", "/samples/mba-603/", "fa-file", false, false, false, false, true);
				$rsSideBar->writeSideBarListItem("Questionnaire", "/samples/questionnaire/", "fa-file-code", false, true, false, false, true);
				$rsSideBar->writeSideBarListClosing();
				$rsSideBar->writeSideBarNavClosing();
			?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="pageStart">
				<article class="container">
					<h1><i class="fa-duotone fa-file-code me-2" aria-hidden="true" id="question-icon"></i>
					Document Conversion</h1>
					<p>This is my primary website development skill: Section 508 and WCAG fixes. What I can do for you is take a document that is not accessible by any measure and convert it to something that looks great no matter what, and is also screen reader friendly.</p>
					<p>In this case, a few years ago, my area&rsquo;s public transportation provider made the decision to shut down service ahead of an approaching winter storm, while still running buses for as long as safely possible. Someone from operations was able to quickly put out a table, quite possibly quickly created in Microsoft Word, to get the information out to the public. However, it was a quick screen shot of a table covering the two service areas. It had no layout. It had shorthands that not everyone would understand. As an image, it absolutely could not be accessed by screen readers. Even if it was a proper table, it had no layout tags so a screen reader would have difficulty deciphering the table &ndash; if it wasn&rsquo;t impossible.</p>
					<p>This is where I can come in. I will take the document and convert it to a format that looks great no matter how someone accesses it.</p>
					<ul class="list-group w-75 mx-auto lead">
						<li class="list-group-item list-group-item-info"><h2 class="text-info"><i class="fa-duotone fa-list-check me-2" aria-hidden="true"></i>Long Story Short</h2></li>
						<li class="list-group-item list-group-item-warning d-flex justify-content-between align-items-start">
							<section class="ms-2 me-auto">
								<section class="fw-bold text-bg-warning badge"><i class="fa-duotone fa-comment-question me-2" aria-hidden="true"></i>The Challenge:</section>
								<p class="pb-0 mb-0">Taking an image of a table that had no layout structure and converting it to screen reader accessible text</p>
							</section>
						</li>
						<li class="list-group-item list-group-item-success d-flex justify-content-between align-items-start">
							<section class="ms-2 me-auto">
								<section class="fw-bold text-bg-success badge"><i class="fa-duotone fa-badge-check me-2" aria-hidden="true"></i>The Result:</section>
								<p class="pb-0 mb-0">A table was contructed in a way that persons of all abilities would be able to parse and understand the context of the data.</p>
							</section>
						</li>
					</ul>
					<p><a href="https://gohrt.com/" target="_blank">Hampton Roads Transit<i class="fa-duotone fa-external-link-alt ms-1" aria-hidden="true"></i></a> put out these tables of ending times for bus service when heavy snow was expected for its service area. This is in a format that is inaccessible to those with impairments that make reading text on images difficult or impossible. After the images, I hand&ndash;converted them to something that is accessible to people of all abilities.</p>
					<p>This is meant to be a demonstration of my skills at making documents accessible.</p>
					<section class="row">
						<section class="col-lg">
							<figure class="figure image fit">
								<img class="figure-img img-fluid rounded" src="trt-snow-end.png" alt="Southside Bus Ending Times (in an Inaccessible Format)" />
								<figcaption class="figure-caption">Bus Service Ending Times on the Southside in a difficult to read image of a table</figcaption>
							</figure>
						</section>
						<section class="col-lg">
							<figure class="figure image fit">
								<img class="figure-img img-fluid rounded" src="pentran-snow-end.png" alt="Peninsula Bus Ending Times (in an Inaccessible Format)" />
								<figcaption class="figure-caption">Bus Service Ending Times on the Peninsula in a difficult to read image of a table</figcaption>
							</figure>
						</section>
					</section>
					<p class="lead">Were you struggling to read the two images that HRT posted? I have put together this table in a format that is accessible to everyone.</p>
					<p class="lead">Allow me to present to you how I would do this. My <i class="fa-duotone fa-snowflake me-1" aria-hidden="true"></i>Winter Weather Alert page shows how I would handle posting these two images up on a website.</p>
					<hr />
                    <h2 class="text-info border-bottom border-info" id="winter-weather-alert"><i class="fa-duotone fa-snowflake me-2" aria-hidden="true"></i>Winter Weather Alert</h2>
					<p class="lead"><span class="badge bg-primary rounded"><strong><i class="fa-duotone fa-calendar me-2" aria-hidden="true"></i>Service Date:</strong> January 21<sup>st</sup>, 2022</span></p>
					<p>Due to the forcasted snowfall, all buses will end service with the last trip of the evening being the first trip in the 6 PM hour. Please refer to the table below for what time the last trip is for your bus.</p>
					<section class="card bg-warning text-light">
						<h2 class="card-header"><i class="fa-duotone fa-exclamation-triangle me-2" aria-hidden="true"></i>Need to Transfer?</h2>
						<section class="card-body">
							<p class="card-text">Please plan any transfers accordingly as the last trip of the evening may not make a connection.</p>
						</section>
					</section>
					<!-- Smaller Screens -->
					<section class="d-lg-none" role="toolbar" aria-label="List of Last Buses on Smaller Screens">
						<section class="container list-group">
							<a href="#trt" class="active list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Southside Bus Service</a>
							<a href="#pentran" class="list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Peninsula Bus Service</a>
							<a href="#light-rail" class="list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-train me-2" aria-hidden="true"></i>Light Rail Service</a>
							<a href="#ferry" class="list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-ship me-2" aria-hidden="true"></i>Ferry Service</a>
						</section>
					</section>

					<!-- Larger Screens -->
					<section class="d-none d-lg-block" role="toolbar" aria-label="List of Last Buses on Larger Screens">
						<section class="container list-group list-group-horizontal">
							<a href="#trt" class="active text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Southside Bus Service</a>
							<a href="#pentran" class="text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Peninsula Bus Service</a>
							<a href="#light-rail" class="text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-train me-2" aria-hidden="true"></i>Light Rail Service</a>
							<a href="#ferry" class="text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-ship me-2" aria-hidden="true"></i>Ferry Service</a>
						</section>
					</section>
					<table class="table align-middle table-striped" id="trt">
						<caption class="caption-top"><i class="fa-duotone fa-bus me-1" aria-hidden="true"></i>Southside Bus Service</caption>
						<thead>
							<tr>
								<th scope="col">Route</th>
								<th scope="col">Outbound</th>
								<th scope="col">Inbound</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">1 Granby Street</th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:35 PM</td>
								<td><strong>Pembroke Mall:</strong> 6:26 PM</td>
							</tr>
							<tr class="table-danger">
								<th scope="row">2 Hampton Boulevard<span class="visually-hidden"> (Possible Error: details after the table)</span></th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:14 PM</td>
								<td><strong>Navy Exchange Mall:</strong> 6:25 AM</td>
							</tr>
							<tr>
								<th scope="row">3 Chesapeake Boulevard</th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:11 PM</td>
								<td><strong>Navy Exchange Mall:</strong> 6:25 PM</td>
							</tr>
							<tr>
								<th scope="row">4 Church Street</th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:34 PM</td>
								<td><strong>Old Dominion University:</strong> 6:00 PM</td>
							</tr>
							<tr class="table-info">
								<th scope="row">5 Willoughby Spit</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr>
								<th scope="row">6 Liberty Street</th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:41 PM</td>
								<td><strong>Summit Pointe:</strong> 6:40 PM</td>
							</tr>
							<tr class="table-danger">
								<th scope="row">8 Tidewater Drive</th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:12 PM</td>
								<td><strong>Evelyn T. Butts Avenue:</strong> 6:48 AM</td>
							</tr>
							<tr>
								<th scope="row">9 Sewells Point Road</th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:30 PM</td>
								<td><strong>Evelyn T. Butts Avenue:</strong> 6:18 PM</td>
							</tr>
							<tr class="table-info">
								<th scope="row">11 Colonial Avenue</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr>
								<th scope="row">12 Indian River Road</th>
								<td><strong>South Norfolk:</strong> 6:48 PM</td>
								<td><strong>Tidewater Community College:</strong> 6:48 PM</td>
							</tr>
							<tr class="table-danger">
								<th scope="row">13 Campostella Road<span class="visually-hidden"> (Possible Error: details after the table)</span></th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:26 PM</td>
								<td><strong>Summit Pointe:</strong> 6:28 AM</td>
							</tr>
							<tr class="table-info">
								<th scope="row">14 Battlefield Boulevard</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr>
								<th scope="row">15 Miltary Highway</th>
								<td><strong>Evelyn T. Butts Avenue:</strong> 6:18 PM</td>
								<td><strong>Robert Hall Boulevard:</strong> 6:19 PM</td>
							</tr>
							<tr>
								<th scope="row">18 Ballentine Boulevard</th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:53 PM</td>
								<td><strong>Hanbury St:</strong> 6:17 PM</td>
							</tr>
							<tr>
								<th scope="row">20 Virginia Beach Boulevard</th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:21 PM</td>
								<td><strong>19<sup>th</sup> &amp; Arctic:</strong> 6:25 PM</td>
							</tr>
							<tr>
								<th scope="row">21 Little Creek Road</th>
								<td><strong>Navy Exchange Mall:</strong> 6:08 PM</td>
								<td><strong>Joint Expeditionary Base Little Creek (Gate 1):</strong> 6:33 PM</td>
							</tr>
							<tr class="table-info">
								<th scope="row">22 Haygood Road</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr>
								<th scope="row">23 Princess Anne Road</th>
								<td><strong><i class="fa-duotone fa-train me-1" aria-hidden="true"></i>Military Highway Station:</strong> 6:37 PM</td>
								<td><strong><i class="fa-duotone fa-train me-1" aria-hidden="true"></i>Fort Norfolk Station:</strong> 6:49 PM</td>
							</tr>
							<tr>
								<th scope="row">24 Kempsville Road</th>
								<td><strong>Pembroke Mall:</strong> 6:00 PM</td>
								<td><strong>Robert Hall Boulevard:</strong> 6:00 PM</td>
							</tr>
							<tr>
								<th scope="row">25 Newtown Road</th>
								<td><strong>Military Circle Mall:</strong> 6:05 PM</td>
								<td><strong>Sentara Princess Anne Hospital:</strong> 6:15 PM</td>
							</tr>
							<tr class="table-info">
								<th scope="row">26 Rosemont Road</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr>
								<th scope="row">27 Northampton Boulevard</th>
								<td><strong><i class="fa-duotone fa-train me-1" aria-hidden="true"></i>Newtown Station:</strong> 6:16 PM</td>
								<td><strong>Pleasure House Rd:</strong> 6:48 PM</td>
							</tr>
							<tr>
								<th scope="row">29 Great Neck Road</th>
								<td><strong>Lynnhaven Mall:</strong> 6:06 PM</td>
								<td><strong>Pleasure House Rd:</strong> 6:48 PM</td>
							</tr>
							<tr>
								<th scope="row">33 General Booth Boulevard</th>
								<td><strong>Tidewater Community College:</strong> 6:13 PM</td>
								<td><strong>68<sup>th</sup> &amp; Atlantic:</strong> 6:33 PM</td>
							</tr>
							<tr>
								<th scope="row">36 Holland Road</th>
								<td><strong>Pembroke Mall:</strong> 6:10 PM</td>
								<td><strong>Tidewater Community College:</strong> 6:48 PM</td>
							</tr>
							<tr class="table-info">
								<th scope="row">41 George Washington Highway</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr class="table-info">
								<th scope="row">43 London Boulevard</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr class="table-danger">
								<th scope="row">44 Turnpike Road<span class="visually-hidden"> (Possible Error: details after the table)</span></th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 7:00 PM</td>
								<td><strong>Starmount Pkwy:</strong> 6:14 PM</td>
							</tr>
							<tr>
								<th scope="row">45 Portsmouth Boulevard</th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:11 PM</td>
								<td><strong>Victory Crossing:</strong> 6:10 PM</td>
							</tr>
							<tr>
								<th scope="row">47 High Street</th>
								<td><strong>County &amp; Court:</strong> 6:03 PM</td>
								<td><strong>Suffolk (Lakeview Pkwy):</strong> 6:43 PM</td>
							</tr>
							<tr class="table-info">
								<th scope="row">58 Bainbridge Boulevard</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr>
								<th scope="row">960 Interstate 264</th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:35 PM</td>
								<td><strong>19<sup>th</sup> &amp; Arctic:</strong> 6:35 PM</td>
							</tr>
							<tr>
								<th scope="row">961 Hampton Roads Bridge&ndash;Tunnel</th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:05 PM</td>
								<td><strong>Newport News Transit Center:</strong> 6:00 PM</td>
							</tr>
						</tbody>
					</table>
					<h3 class="text-danger border-bottom border-danger"><i class="fa-duotone fa-exclamation-triangle me-2" aria-hidden="true"></i>Errors in Southside Bus Service Table</h3>
					<p>The times were copied exactly from the original images, including any possible errors. If this was being done in a live production environment, I would&rsquo;ve asked what the correct times were, as well as why one route was omitted from the list.</p>
					<p>What I think are the corrections that need to be made are below</p>
					<ul class="list-group">
						<li class="list-group-item list-group-item-danger"><strong>2 Hampton Boulevard:</strong> Last trip from Navy Exchange Mall should be 6:25 PM</li>
						<li class="list-group-item list-group-item-danger"><strong>8 Tidewater Dr:</strong> Last trip from Evelyn T. Butts Ave should be 6:48 PM</li>
						<li class="list-group-item list-group-item-danger"><strong>13 Campostella Rd:</strong> Last trip from Summit Pointe should be 6:28 PM</li>
						<li class="list-group-item list-group-item-danger"><strong>44 Turnpike Rd:</strong> Last trip from Downtown Norfolk Transit Center should probably be listed as 6:00 PM</li>
						<li class="list-group-item list-group-item-danger"><strong>50 Greenwood Dr:</strong> Route is missing in original document. Since it ends in the 6:00 PM hour, it will run normal schedule anyway</li>
					</ul>
					<!-- Smaller Screens -->
					<section class="d-lg-none" role="toolbar" aria-label="List of Last Buses on Smaller Screens">
						<section class="container list-group">
							<a href="#trt" class="list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Southside Bus Service</a>
							<a href="#pentran" class="active list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Peninsula Bus Service</a>
							<a href="#light-rail" class="list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-train me-2" aria-hidden="true"></i>Light Rail Service</a>
							<a href="#ferry" class="list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-ship me-2" aria-hidden="true"></i>Ferry Service</a>
						</section>
					</section>

					<!-- Larger Screens -->
					<section class="d-none d-lg-block" role="toolbar" aria-label="List of Last Buses on Larger Screens">
						<section class="container list-group list-group-horizontal">
							<a href="#trt" class="text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Southside Bus Service</a>
							<a href="#pentran" class="active text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Peninsula Bus Service</a>
							<a href="#light-rail" class="text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-train me-2" aria-hidden="true"></i>Light Rail Service</a>
							<a href="#ferry" class="text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-ship me-2" aria-hidden="true"></i>Ferry Service</a>
						</section>
					</section>
					<table class="table align-middle table-striped" id="pentran">
						<caption class="caption-top"><i class="fa-duotone fa-bus me-1" aria-hidden="true"></i>Peninsula Bus Service</caption>
						<thead>
							<tr>
								<th scope="col">Route</th>
								<th scope="col">Outbound</th>
								<th scope="col">Inbound</th>
							</tr>
						</thead>
						<tbody>
							<tr class="table-info">
								<th scope="row">64 James River Bridge</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr>
								<th scope="row">101 Kecoughtan Road</th>
								<td><strong>Newport News Transit Center:</strong> 6:45 PM</td>
								<td><strong>Hampton Transit Center:</strong> 6:45 PM</td>
							</tr>
							<tr>
								<th scope="row">102 Queen Street</th>
								<td><strong>Peninsula Town Center:</strong> 6:52 PM</td>
								<td><strong>Hampton Transit Center:</strong> 6:19 PM</td>
							</tr>
							<tr>
								<th scope="row">103 Shell Road</th>
								<td><strong>Newport News Transit Center:</strong> 6:15 PM</td>
								<td><strong>Hampton Transit Center:</strong> 6:18 PM</td>
							</tr>
							<tr>
								<th scope="row">104 Marshall Avenue</th>
								<td class="table-info"><strong>Newport News Transit Center:</strong> Regular Time</td>
								<td><strong>81<sup>st</sup> &amp; Orcutt:</strong> 6:15 PM</td>
							</tr>
							<tr>
								<th scope="row">105 Maple Avenue</th>
								<td><strong>Peninsula Town Center:</strong> 6:15 PM</td>
								<td><strong>27<sup>th</sup> &amp; Maple:</strong> 6:15 PM</td>
							</tr>
							<tr class="table-info">
								<th scope="row">106 Warwick Boulevard</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr>
								<th scope="row">107 Warwick Boulevard</th>
								<td><strong>Newport News Transit Center:</strong> 6:15 PM</td>
								<td><strong>Patrick Henry Mall:</strong> 6:15 PM</td>
							</tr>
							<tr>
								<th scope="row">108 Jefferson Avenue &amp; Warwick Boulevard</th>
								<td><strong>Lee Hall:</strong> 6:27 PM</td>
								<td><strong>Riverside Regional Medical Center:</strong> 6:35 PM</td>
							</tr>
							<tr class="table-info">
								<th scope="row">109 Pembroke Avenue</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr>
								<th scope="row">110 Briarfield Road</th>
								<td><strong>Thomas Nelson Community College:</strong> 5:55 PM</td>
								<td><strong>Hampton Transit Center:</strong> 6:00 PM</td>
							</tr>
							<tr>
								<th scope="row">111 Jefferson Avenue</th>
								<td><strong>Old Denbigh Boulevard &amp; Woodside Ln:</strong> 6:20 PM</td>
								<td><strong>Thomas Nelson Community College:</strong> 6:00 PM</td>
							</tr>
							<tr>
								<th scope="row">112 Jefferson Avenue</th>
								<td><strong>6<sup>th</sup> &amp; Ivy:</strong> 6:03 PM</td>
								<td><strong>Lee Hall:</strong> 6:07 PM</td>
							</tr>
							<tr>
								<th scope="row">114 Mercury Boulevard</th>
								<td><strong>73<sup>rd</sup> &amp; Warwick:</strong> 6:15 PM</td>
								<td><strong>Hampton Transit Center:</strong> 6:20 PM</td>
							</tr>
							<tr>
								<th scope="row">115 Fox Hill Road</th>
								<td><strong>Buckroe Beach:</strong> 6:11 PM</td>
								<td><strong>Hampton Transit Center:</strong> 6:45 PM</td>
							</tr>
							<tr class="table-info">
								<th scope="row">117 Settlers Landing Road</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr class="table-info">
								<th scope="row">118 Armistead Avenue</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr class="table-info">
								<th scope="row">120 Mallory Street</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr class="table-info">
								<th scope="row">121 Interstate 64</th>
								<td colspan="2" class="fw-bold">Service Ends at Regular Time</td>
							</tr>
							<tr>
								<th scope="row">961 Hampton Roads Bridge&ndash;Tunnel</th>
								<td><strong>Downtown Norfolk Transit Center:</strong> 6:05 PM</td>
								<td><strong>Newport News Transit Center:</strong> 6:00 PM</td>
							</tr>
						</tbody>
					</table>
					<!-- Smaller Screens -->
					<section class="d-lg-none" role="toolbar" aria-label="List of Last Buses on Smaller Screens">
						<section class="container list-group">
							<a href="#trt" class="list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Southside Bus Service</a>
							<a href="#pentran" class="list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Peninsula Bus Service</a>
							<a href="#light-rail" class="active list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-train me-2" aria-hidden="true"></i>Light Rail Service</a>
							<a href="#ferry" class="list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-ship me-2" aria-hidden="true"></i>Ferry Service</a>
						</section>
					</section>

					<!-- Larger Screens -->
					<section class="d-none d-lg-block" role="toolbar" aria-label="List of Last Buses on Larger Screens">
						<section class="container list-group list-group-horizontal">
							<a href="#trt" class="text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Southside Bus Service</a>
							<a href="#pentran" class="text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Peninsula Bus Service</a>
							<a href="#light-rail" class="active text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-train me-2" aria-hidden="true"></i>Light Rail Service</a>
							<a href="#ferry" class="text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-ship me-2" aria-hidden="true"></i>Ferry Service</a>
						</section>
					</section>
					<table class="table align-middle table-striped" id="light-rail">
						<caption class="caption-top"><i class="fa-duotone fa-train me-1" aria-hidden="true"></i>Light Rail Service</caption>
						<thead>
							<tr>
								<th scope="col">Route</th>
								<th scope="col">Outbound</th>
								<th scope="col">Inbound</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">800 The Tide</th>
								<td><strong><i class="fa-duotone fa-train me-1" aria-hidden="true"></i>Newtown Station:</strong> 6:05 PM</td>
								<td><strong><i class="fa-duotone fa-train me-1" aria-hidden="true"></i>Fort Norfolk Station:</strong> 6:11 PM</td>
							</tr>
						</tbody>
					</table>
					<!-- Smaller Screens -->
					<section class="d-lg-none" role="toolbar" aria-label="List of Last Buses on Smaller Screens">
						<section class="container list-group">
							<a href="#trt" class="list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Southside Bus Service</a>
							<a href="#pentran" class="list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Peninsula Bus Service</a>
							<a href="#light-rail" class="list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-train me-2" aria-hidden="true"></i>Light Rail Service</a>
							<a href="#ferry" class="active list-group-item list-group-action list-group-item-info"><i class="fa-duotone fa-ship me-2" aria-hidden="true"></i>Ferry Service</a>
						</section>
					</section>

					<!-- Larger Screens -->
					<section class="d-none d-lg-block" role="toolbar" aria-label="List of Last Buses on Larger Screens">
						<section class="container list-group list-group-horizontal">
							<a href="#trt" class="text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Southside Bus Service</a>
							<a href="#pentran" class="text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-bus me-2" aria-hidden="true"></i>Peninsula Bus Service</a>
							<a href="#light-rail" class="text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-train me-2" aria-hidden="true"></i>Light Rail Service</a>
							<a href="#ferry" class="active text-center list-group-item list-group-item-dark list-group-item-action flex-fill"><i class="fa-duotone fa-ship me-2" aria-hidden="true"></i>Ferry Service</a>
						</section>
					</section>
					<table class="table align-middle table-striped" id="ferry">
						<caption class="caption-top"><i class="fa-duotone fa-ship me-1" aria-hidden="true"></i>Ferry Service</caption>
						<thead>
							<tr>
								<th scope="col"><i class="fa-duotone fa-ship me-1" aria-hidden="true"></i>High Street</th>
								<th scope="col"><i class="fa-duotone fa-ship me-1" aria-hidden="true"></i>North Landing</th>
								<th scope="col"><i class="fa-duotone fa-ship me-1" aria-hidden="true"></i>Waterside</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>6:35 PM</td>
								<td>6:40 PM</td>
								<td>6:50 PM</td>
							</tr>
						</tbody>
					</table>
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