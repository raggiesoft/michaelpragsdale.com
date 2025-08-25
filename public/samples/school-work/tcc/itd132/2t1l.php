<?php
	$servername = "localhost";
	$username = "raggiesoft";
	$password = "TheGre8tPit+";
	$dbname = "TCC_ITD132";

    $conn = new mysqli($servername, $username, $password, $dbdame);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
	$conn->select_db("TCC_ITD132");

    include("../../../../../includes/utilities.php");
	include("../../../../../includes/navigator.php");
	include("../../../../../includes/footer.php");
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

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">


    <title>ITD 132 School Work - Michael Ragsdale's Portfolio</title>
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
					$rsSideBar = new SideNav("ITD 132", "fa-school",false, true);
					$rsSideBar->writeSideBarListOpening();
					$rsSideBar->writeSideBarListItem("Home", "index.php", "fa-home", false, true);
					$rsSideBar->writeSideBarListItem("Get to Know Me", "2t1l.php", "fa-clipboard-list-check", true, false);
					
					$rsSideBar->writeSideBarListClosing();
					$rsSideBar->writeSideBarNavClosing();
					
			?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="pageStart">
				<article class="container">
					<h1><i class="fa-duotone fa-tasks me-2" aria-hidden="true"></i>Introducing, Well, Me</h1>
					<!-- Avatar of me. Smaller Screens then Large Screen -->
					<section class="d-lg-none">
						<img src="https://michaelpragsdale.com/assets/images/og/avatar-square.png" class="me-2 mb-2 w-100 rounded-3" />
					</section>
					<section class="d-none d-lg-block">
						<img src="https://michaelpragsdale.com/assets/images/og/avatar-square.png" class="float-start me-2 mb-2 w-25 rounded-3" />
					</section>
					
                    <wa-badge class="pronouns" pill pulse><strong><i class="fa-duotone fa-mars-stroke me-2" aria-hidden="true"></i>Pronouns:</strong> He, Him, His</wa-badge>
					<p>Greetings everyone! I am returning to TCC to get that piece of paper that says I know how to do what this page demonstrates. My background is in PHP web development, and this is really my first time dipping my toes in the water of working directly with databases.</p>
					<p>I came back to TCC because ODU screwed me over and decided that me earning a C in the one last class I needed to graduate wasn&rsquo;t gooe enough. Story time: They let me walk in Spring 2019 ceremony, then only last spring they decided to tell me that I had one more class. I forgot all about everything because of the world shutting down in 2020. I took the class, earned a C (and this was after the instructor refused to grade some assignments, claiming they were broken - <a href="../../odu/ids300w/" target="_blank">You Tell Me if this is broken</a>), and was told No Good.</p>
					<h2><i class="fa-duotone fa-game-board me-2" aria-hidden="true"></i>Let&rsquo;s Play a Game</h2>
					<p>As part of a get to know you session for this class, there are Truths and a Lie. See if you can guess which is which. As a demonstration of my SQL knowledge, this pulls from a MariaDB database.</p>
                    <?php
					// This code is dirty but it works in a pinch. (C) 2025 Michael Ragsdale (RaggieSoft). Some rights reserved. See GPL v3.
$sql = "SELECT * FROM TRUTH_LIE";
try
{	
	$result = $conn->query($sql);
}
catch (Exception $ex)
{
	echo $ex;
	die();
}
if ($result->num_rows > 0)
{
    echo "\t\t\t\t\t<table class=\"table\">" . PHP_EOL;
	echo "\t\t\t\t\t\t<thead>" . PHP_EOL;
	echo "\t\t\t\t\t\t\t<tr>" . PHP_EOL;
	echo "\t\t\t\t\t\t\t\t<th scope=\"col\">Entry</th>" . PHP_EOL;
	echo "\t\t\t\t\t\t\t\t<th scope=\"col\">Statement</th>" . PHP_EOL;
	echo "\t\t\t\t\t\t\t\t<th scope=\"col\">Truth or Lie</th>" . PHP_EOL;
	if (isset($_GET['reveal-answer']))
	{
		if (strtolower($_GET['reveal-answer']) == "true")
		{
			echo "\t\t\t\t\t\t\t\t<th scope=\"col\">Explanation</th>" . PHP_EOL;
		}
	}
	echo "\t\t\t\t\t\t\t</tr>" . PHP_EOL;
	echo "\t\t\t\t\t\t</thead>" . PHP_EOL;
	echo "\t\t\t\t\t\t<tbody>" . PHP_EOL;
	$i = 0;
	while($row = $result->fetch_assoc())
	{
		echo "\t\t\t\t\t\t\t<tr id=\"statement" . $i . "\">" . PHP_EOL;
		echo "\t\t\t\t\t\t\t<th scope=\"row\">" . $row['LIE_KEY'] . "</td>" . PHP_EOL;
		echo "\t\t\t\t\t\t\t<td>" . $row['STATEMENT'] . "</td>" . PHP_EOL;
		echo "\t\t\t\t\t\t\t<td>";
		if (isset($_GET['reveal-answer']))
		{
			if (strtolower($_GET['reveal-answer']) == "true")
			{
				if ($row['IS_LIE'] == 0)
				{
					echo "Truth";
				}
				else
				{
					echo "Lie";
				}
			}
			else
			{
				echo "Take a Guess";
			}
		}
		else
		{
			echo "Take a Guess";
		}
		echo "</td>" . PHP_EOL;	
		if (isset($_GET['reveal-answer']))
		{
			if (strtolower($_GET['reveal-answer']) == "true")
			{
				echo "\t\t\t\t\t\t\t<td>" . $row['EXPLANATION'] . "</td>" . PHP_EOL;
			}
		}
		echo "\t\t\t\t\t\t\t</tr>" . PHP_EOL;
	}
	echo "\t\t\t\t\t\t\t</table>";
}
// Close the database connection
$conn->close();
?>
	  				<p>Can you guess which one is the lie?</p>
					<a href="2t1l.php?reveal-answer=true" class="btn btn-info" id="button-lie">Show the Lie</a>
					<a href="javascript:showLieCode();" class="btn btn-info" id="button-lie-code">Show the Code for the Lie Database</a>
					<section id="lie-explainer"></section>
					<section id="lie-code"><pre><code>// (C) 2025 Michael Ragsdale (RaggieSoft). Some Rights Reserved. See GPLv3. Yes, this code is sloppy, but it is quick and dirty.
$servername = "localhost";
$username = "raggiesoft";
$password = "******"; // Do you really think I'm going to share my password
$dbname = "TCC_ITD132";

$conn = new mysqli($servername, $username, $password, $dbdame);
if ($conn->connect_error)
{
	die("Connection failed: " . $conn->connect_error);
}
$conn->select_db("TCC_ITD132"); // Don't know why, but we have to select the database, AGAIN!
$sql = "SELECT * FROM TRUTH_LIE";
try
{	
	$result = $conn->query($sql);
}
catch (Exception $ex)
{
	echo $ex;
	die();
}
if ($result->num_rows > 0)
{
    echo "\t\t\t\t\t<table class=\"table\">" . PHP_EOL;
	echo "\t\t\t\t\t\t<thead>" . PHP_EOL;
	echo "\t\t\t\t\t\t\t<tr>" . PHP_EOL;
	echo "\t\t\t\t\t\t\t\t<th scope=\"col\">Entry</th>" . PHP_EOL;
	echo "\t\t\t\t\t\t\t\t<th scope=\"col\">Statement</th>" . PHP_EOL;
	echo "\t\t\t\t\t\t\t\t<th scope=\"col\">Truth or Lie</th>" . PHP_EOL;
	if (isset($_GET['reveal-answer']))
	{
		if (strtolower($_GET['reveal-answer']) == "true")
		{
			echo "\t\t\t\t\t\t\t\t<th scope=\"col\">Explanation</th>" . PHP_EOL;
		}
	}
	echo "\t\t\t\t\t\t\t</tr>" . PHP_EOL;
	echo "\t\t\t\t\t\t</thead>" . PHP_EOL;
	echo "\t\t\t\t\t\t<tbody>" . PHP_EOL;
	$i = 0;
	while($row = $result->fetch_assoc())
	{
		echo "\t\t\t\t\t\t\t<tr id=\"statement" . $i . "\">" . PHP_EOL;
		echo "\t\t\t\t\t\t\t<th scope=\"row\">" . $row['LIE_KEY'] . "</td>" . PHP_EOL;
		echo "\t\t\t\t\t\t\t<td>" . $row['STATEMENT'] . "</td>" . PHP_EOL;
		echo "\t\t\t\t\t\t\t<td>";
		if (isset($_GET['reveal-answer']))
		{
			if (strtolower($_GET['reveal-answer']) == "true")
			{
				if ($row['IS_LIE'] == 0)
				{
					echo "Truth";
				}
				else
				{
					echo "Lie";
				}
			}
			else
			{
				echo "Take a Guess";
			}
		}
		else
		{
			echo "Take a Guess";
		}
		echo "</td>" . PHP_EOL;	
		if (isset($_GET['reveal-answer']))
		{
			if (strtolower($_GET['reveal-answer']) == "true")
			{
				echo "\t\t\t\t\t\t\t<td>" . $row['EXPLANATION'] . "</td>" . PHP_EOL;
			}
		}
		echo "\t\t\t\t\t\t\t</tr>" . PHP_EOL;
	}
	echo "\t\t\t\t\t\t\t</table>";
}
// Close the database connection
$conn->close();</pre></code></section>
					<h2><i class="fa-duotone fa-question-circle me-2" aria-hidden="true"></i>Why am I Here?</h2>
					<ul class="list-group">
						<li class="list-group-item">I am taking this class because I have a background in PHP but now it&rsquo;s time to learn the other half: databases</li>
						<li class="list-group-item">This class is for a Degree, and it is for Web Development.</li>
						<li class="list-group-item">I was supposed to have a Bachelor, but there&rsquo;s a long story (short version above)</li>
						<li class="list-group-item">I was one of the developers at ODU who migrated the university from Personal Learning Environment (PLE) which was an in-house CMS, to Canvas, and we did this during the height of COVID. Do not tell me web work has to be done in-person because COVID proved all of us wrong.</li>
					</ul>
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

	<!-- No cheating!! -->
	<script src="lie.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

	<!-- Highlight -->
	<script>hljs.highlightAll();</script>
</body>

</html>