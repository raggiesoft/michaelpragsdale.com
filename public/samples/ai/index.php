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
    <meta name="description" property="og:description" content="This is my writeup on Artificial Intelligence." />
    <meta property="og:image" content="https://michaelpragsdale.com/assets/images/og/contact-me.png" />
    <meta property="og:title" content="AI - Michael Ragsdale&rsquo;s Portfolio" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://michaelpragsdale.com/samples/ai/" />
	
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
                $rsNav->writeButtonNav("AI", "/samples/ai/", "fa-file", true, false);
                $rsNav->writeButtonNav("Document Conversion", "/samples/document-conversion/", "fa-file-code", false, false);
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
                $rsSideBar->writeSideBarListItem("Go Up", "/samples/", "fa-chevron-up", false, true);
				$rsSideBar->writeSideBarListItem("AI", "/samples/ai/", "fa-file", true, false, false, false, true);
                $rsSideBar->writeSideBarListItem("Document Conversion", "/samples/document-conversion/", "fa-file-code", false, false, false, false, true);
				$rsSideBar->writeSideBarListItem("MBA Self-Check Quiz", "/samples/mba-603/", "fa-file", false, false, false, false, true);
				$rsSideBar->writeSideBarListItem("Questionnaire", "/samples/questionnaire/", "fa-file-code", false, true, false, false, true);
				$rsSideBar->writeSideBarListClosing();
				$rsSideBar->writeSideBarNavClosing();
			?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="pageStart">
				<article class="container">
					<h1><i class="fa-duotone fa-robot me-2" aria-hidden="true" id="question-icon"></i>Artificial Intelligence</h1>
                    <figure class="figure">
                        <img src="ai-siblings/college/hero-images/welcome-to-college/01-welcome-to-college.png" class="img-fluid" alt="David and his sisters Aubrie and Shannon on their first day of College" />
                        <figcaption class="figure-caption">David and his two sisters Aubrie and Shannon on their first day of college.</figcaption>
                    </figure>
					<p>I am starting to play around with <em>Microsoft Designer</em> and use AI to create characters for stories. I also wrote a paper on AI for a class I took at Old Dominion University. Note the errors in the image above. Where I live in this world, it is supposed to be a hot, miserable, but sunny day. AI decided to draw this image anyway as if it was autumn with warm sweatshirts and the leaves dropping from the trees.</p>
					<h2><i class="fa-duotone fa-user-robot me-2" aria-hidden="true"></i>My AI Background</h2>
					<figure class="figure float-start w-25 me-2">
						<img src="ai-siblings/teenagers/basketball/03-evening-basketball-after-game.png" class="img-fluid" alt= "Three siblings hugging each other on a bench." />
						<figcaption class="figure-caption"><strong>Left to Right:</strong> Shannon, David, and Aubrie sitting on a bench after a game of backyard basketball</figcaption>
					</figure>
					<p>While I am not versed in the realm of machine learning as well as the computing power necessary to power tools like Designer, I am appreciating the tool from the end-user level. Yes, AI does have its faults (and a lot of legal questions), but this is a game changer for me.</p>
					<p><i class="fa-duotone fa-universal-access me-1" aria-hidden="true"></i>I am mobility impaired and autistic. I have these great ideas that are in my head, but the difficulty is transferring the ideas from brain to pen and paper (or, in this case, PNG image). I don&rsquo;t have the fine motor skills necessary to handle drawing onto a computer with precision even with my WACOM tablet, iPad, and Apple Pencil. I don&rsquo;t have the patience to take the time to ensure something is completely accurate. For a while, I would use <em>The Sims 4</em> to map out my characters, but the game does have its limitations. As a perfect example: I could never recreate the three siblings sitting on a bench hugging each other.</p>
					<section class="clearfix">&nbsp;</section>
					<h2><i class="fa-duotone fa-school me-2" aria-hidden="true"></i>AI Paper</h2>
					<p>At the University level, I am writing a paper on AI, focusing on the question of copyright as well as the limitations (some of which are easily spotted in the image above). When I am ready to publish it, it will be posted here.</p>
				</article>
            </main>
		<!-- JavaScript Libraries -->
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