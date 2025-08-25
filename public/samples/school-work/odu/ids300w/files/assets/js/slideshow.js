// (C) 2024 Michael Ragsdale (RaggieSoft). michael.ragsdale@raggiesoft.com
// Some rights reserved.

// Where are we in the slideshow? Load in a garbage entry
// because we'll know if the code breaks because there's
// no such thing as slide -1
let currentSlide = -1;

// Set up our current View Mode
let viewMode = 0; // 0 = slide show, 1 = view all

// Document Host
let docuPreloaderHost = document.getElementById("preloader-host");
let docuMain = document.querySelector("main");

// Let's bring up the first slide
function pageStart()
{
	// Get our list of slides (they are all cards)
	let slides = document.getElementsByClassName("card");
	
	hideAllSlides();
	
	// Except the First one
	document.getElementById("step1").classList.remove("d-none");
	let stepCounter = document.getElementById("step-counter");
	
	
	// Update our Slide Location
	currentSlide = 0;
	
	
	// Enable/disable buttons as necessary
	editButtonAttributes("btn-start", false);
	editButtonAttributes("btn-back", false);
	editButtonAttributes("btn-next", true);
	editButtonAttributes("btn-end", true);

	setImage(currentSlide);

	// Scroll the screen back to the top
	window.scrollTo({ top: 0, behavior: 'smooth' });
}

// The background images are large and this shows a loading progress
function preLoadImages()
{
	
	// Hide Main
	docuMain.style.display = "none";
	
	// Preload Images (relative to the HTML file, unlike setImage() below)
	let img = new Image();
	for (let i = 1; i <= 10; i++)
	{
		setPorgress(i, 0, 100, i, 10);
		img.src = "assets/images/step" + i + ".png";
	}
	img.src = "assets/images/step-all.png";

	// We're ready to show the web page
	docuPreloaderHost.style.display = "none";
	docuMain.style.display = "block";
}

// Update our Loading Progress
function setPorgress(pgbValue, pgbMin, pgbMax, slideNum, slideMax)
{
	// Reserve a spot in memory for the elements
	let pgbWrapper = document.getElementById("preloader-progressbar-wrapper");
	let pgbBar = document.getElementById("preloader-progressbar");
	let lblProgress = document.getElementById("preloader-text");

	// Update the label
	lblProgress.innerHTML = "<p>Loading Slide " + slideNum + " of " + slideMax + "</p>";

	// Update the Progress Bar Wrapper
	pgbWrapper.setAttribute("aria-valuenow", pgbValue);
	pgbWrapper.setAttribute("aria-value-min", pgbMin);
	pgbWrapper.setAttribute("aria-valuemax", pgbMax);

	// Update the Progress Bar itself
	pgbBar.style.width = pgbValue;
}
// Rotates the images for the different slides
function setImage(currentSlideNum)
{
	// The image is hosted on main::before in the custom property --rs-background-image
	let docuMain = document.querySelector("main");

	let setBackgroundImage = () =>
	{
		// [HEADS UP] Images are relative to the CSS folder
		// So, back up from CSS to ASSETS then browse to the IMAGES
		let imageName = "url('../images/step" + (currentSlideNum + 1) + ".png')";

		// Show All Slides
		if (currentSlideNum == -2)
		{
			imageName = "url('../images/step-all.png')";
		}
		return imageName;
	}

	docuMain.style.setProperty("--rs-background-image", setBackgroundImage());

	for (i = 0; i < 10; i++)
	{
		let stepCounterCurrent = document.getElementById("step-counter-" + (i + 1))
		stepCounterCurrent.classList.remove("active");
		if (currentSlideNum != -2)
		{
			if (i == currentSlide)
			{
				stepCounterCurrent.classList.add("active");
			}
		}
	}

}

// Let's bring up the last slide
function pageEnd()
{
	// Get our list of slides (they are all cards)
	let slides = document.getElementsByClassName("card");
	
	hideAllSlides();
	
	// Except the Last One
	document.getElementById("step10").classList.remove("d-none");
	
	// Enable / Disable buttons as necessary
	editButtonAttributes("btn-start", true);
	editButtonAttributes("btn-back", true);
	editButtonAttributes("btn-next", false);
	editButtonAttributes("btn-end", false);
	
	// Update our Slide Location
	// Get the total slides and convert to 0-based
	currentSlide = slides.length - 1;

	setImage(currentSlide);

	// Scroll the screen back to the top
	window.scrollTo({ top: 0, behavior: 'smooth' });
}


// Advances the slideshow forward or backward
function slideGo(slideGoDirection)
{
	// -1: go backwards
	// 1: go forwards
	
	// Get our list of slides (they are all cards)
	let slides = document.getElementsByClassName("card");
	
	// Go Back if we can
	if (slideGoDirection == -1)
	{
		if (currentSlide > 0)
		{
			hideAllSlides();
			slides[currentSlide - 1].classList.remove("d-none");
			currentSlide--;
		}
		if (currentSlide == 0)
		{
			editButtonAttributes("btn-start", false);
			editButtonAttributes("btn-back", false);
			editButtonAttributes("btn-next", true);
			editButtonAttributes("btn-end", true);
		}
	}
	
	// Go Forward if we can
	if (slideGoDirection == 1)
	{
		if (currentSlide < slides.length)
		{
			hideAllSlides();
			slides[currentSlide + 1].classList.remove("d-none");
			currentSlide++;
		}
		
		if (currentSlide == slides.length)
		{
			editButtonAttributes("btn-start", true);
			editButtonAttributes("btn-back", true);
			editButtonAttributes("btn-next", false);
			editButtonAttributes("btn-end", false);
		}
	}
	
	if (currentSlide == slides.length - 1)
	{
		editButtonAttributes("btn-start", true);
		editButtonAttributes("btn-back", true);
		editButtonAttributes("btn-next", false);
		editButtonAttributes("btn-end", false);
	}
	else if (currentSlide == 0)
	{
		editButtonAttributes("btn-start", false);
		editButtonAttributes("btn-back", false);
		editButtonAttributes("btn-next", true);
		editButtonAttributes("btn-end", true);
	}
	else
	{
		editButtonAttributes("btn-start", true);
		editButtonAttributes("btn-back", true);
		editButtonAttributes("btn-next", true);
		editButtonAttributes("btn-end", true);
	}

	setImage(currentSlide);

	// Scroll the screen back to the top
	window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Enable/disable the buttons as needed
function editButtonAttributes(buttonName, enableButton)
{
	// Get our list of slides (they are all cards)
	let slides = document.getElementsByClassName("card");
	
	// Get our Button
	let buttonObject = document.getElementById(buttonName);
	
	// Colors to pick from
	let colorChoice = 
	{
		colorPrimary: "btn-primary",
		colorSecondary: "btn-secondary",
		colorInfo: "btn-info"
	};
	
	// Clear all the classes except the Bootstrap Button
	buttonObject.className = "btn";
	
	// Add the Bootstrap Button back in
	if (enableButton)
	{
		buttonObject.removeAttribute("disabled");
		switch (buttonName)
		{
			case "btn-next":
				buttonObject.className = "btn " + colorChoice.colorPrimary;
				break;
			default:
				buttonObject.className = "btn " + colorChoice.colorInfo;
		}
	}
	else
	{
		buttonObject.setAttribute("disabled", "disabled");
		buttonObject.className = "btn " + colorChoice.colorSecondary;
	}
	
}

function changeView()
{
	// Get our list of slides (they are all cards)
	let slides = document.getElementsByClassName("card");
	if (viewMode == 0)
	{
		viewMode = 1;
		showAllSlides();
		editButtonAttributes("btn-start", false);
		editButtonAttributes("btn-back", false);
		editButtonAttributes("btn-next", false);
		editButtonAttributes("btn-end", false);
		
		document.getElementById("btn-all").innerHTML = "<i class=\"fa-duotone fa-eye me-2\" aria-hidden=\"true\"></i>View Current Slide";
		setImage(-2);
		return;
	}
	
	if (viewMode == 1)
	{
		viewMode = 0;
		hideAllSlides();
		document.getElementById("btn-all").innerHTML = "<i class=\"fa-duotone fa-eye me-2\" aria-hidden=\"true\"></i>View All Slides";
		
		document.getElementById("step" + (currentSlide + 1)).classList.remove("d-none");
		
		if (currentSlide == 0)
		{
			editButtonAttributes("btn-start", false);
			editButtonAttributes("btn-back", false);
			editButtonAttributes("btn-next", true);
			editButtonAttributes("btn-end", true);
		}
		else if (currentSlide == slides.length)
		{
			editButtonAttributes("btn-start", true);
			editButtonAttributes("btn-back", true);
			editButtonAttributes("btn-next", false);
			editButtonAttributes("btn-end", false);
		}
		else
		{
			editButtonAttributes("btn-start", true);
			editButtonAttributes("btn-back", true);
			editButtonAttributes("btn-next", true);
			editButtonAttributes("btn-end", true);
		}

		setImage(currentSlide);
		return;
	}
		
}

function hideAllSlides()
{
	// Get our list of slides (they are all cards)
	let slides = document.getElementsByClassName("card");
	
	// Iterate through them, hiding ALL of them
	for (let i = 0; i < slides.length; i++)
	{
		slides[i].classList.add("d-none");
	}
}

function showAllSlides()
{
	// Get our list of slides (they are all cards)
	let slides = document.getElementsByClassName("card");
	
	// Iterate through them, hiding ALL of them
	for (let i = 0; i < slides.length; i++)
	{
		slides[i].classList.remove("d-none");
	}
}

// Let's show a specific slide
function showSlide(slideNum)
{
	if (viewMode == 1)
	{
		// If we are in view mode, just show all slides
		showAllSlides();
		return;
	}
	else
	{
		// The user has requested a specific slide
		let slides = document.getElementsByClassName("card");
		// Iterate through them, hiding ALL of them
		for (let i = 0; i < slides.length; i++)
		{
			slides[i].classList.add("d-none");
		}
		// Show the requested slide
		slides[slideNum].classList.remove("d-none");
		// Show the correct buttons
		if (currentSlide == slides.length - 1)
		{
			editButtonAttributes("btn-start", true);
			editButtonAttributes("btn-back", true);
			editButtonAttributes("btn-next", false);
			editButtonAttributes("btn-end", false);
		}
		else if (currentSlide == 0)
		{
			editButtonAttributes("btn-start", false);
			editButtonAttributes("btn-back", false);
			editButtonAttributes("btn-next", true);
			editButtonAttributes("btn-end", true);
		}
		else
		{
			editButtonAttributes("btn-start", true);
			editButtonAttributes("btn-back", true);
			editButtonAttributes("btn-next", true);
			editButtonAttributes("btn-end", true);
		}
	}

	// Scroll the screen back to the top
	window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Preload the Background Images
preLoadImages();

// Begin our slideshow on slide 1
pageStart();