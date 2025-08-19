/**
 * My Portfolio Website
 * Copyright (c) 2025 Michael Ragsdale
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 */

/**
 * Initializes the mobile navigation, including the toggle button
 * and "click outside to close" functionality. This is a global function
 * that runs on every page of the site.
 */
function initMobileNav() {
    // Get references to all the necessary HTML elements.
    const body = document.body;
    const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
    const navIcon = document.querySelector('.mobile-nav-toggle .fa-duotone');
    const navPanel = document.querySelector('.site-navigation');

    // If any of these core elements are missing, stop the script to prevent errors.
    if (!mobileNavToggle || !navIcon || !navPanel) return;

    // --- Helper functions for opening and closing the menu ---

    /**
     * Closes the mobile navigation panel.
     */
    const closeNav = () => {
        body.classList.remove('nav-is-open');
        navIcon.classList.remove('fa-xmark'); // Change icon back to hamburger
        navIcon.classList.add('fa-bars');
        mobileNavToggle.setAttribute('aria-expanded', 'false'); // For accessibility
    };

    /**
     * Opens the mobile navigation panel.
     */
    const openNav = () => {
        body.classList.add('nav-is-open');
        navIcon.classList.remove('fa-bars');
        navIcon.classList.add('fa-xmark'); // Change icon to a close 'X'
        mobileNavToggle.setAttribute('aria-expanded', 'true'); // For accessibility
    };

    // --- Event Listeners ---

    // 1. Listen for clicks on the main hamburger toggle button.
    mobileNavToggle.addEventListener('click', (event) => {
        // Stop this click from immediately being caught by the 'document' listener below,
        // which would cause the menu to close right after opening.
        event.stopPropagation();
        // Check if the menu is currently open and call the appropriate function.
        body.classList.contains('nav-is-open') ? closeNav() : openNav();
    });

    // 2. Listen for clicks anywhere on the document to handle "click outside to close".
    document.addEventListener('click', (event) => {
        // Only run this logic if the navigation is currently open.
        if (body.classList.contains('nav-is-open')) {
            // Check if the click happened *inside* the nav panel or on the toggle button itself.
            const isClickInsideNav = navPanel.contains(event.target);
            const isClickOnToggle = mobileNavToggle.contains(event.target);

            // If the click was NOT inside the nav and NOT on the toggle, close the menu.
            if (!isClickInsideNav && !isClickOnToggle) {
                closeNav();
            }
        }
    });

    // 3. Listen for clicks on any link inside the navigation panel to close it after navigation.
    navPanel.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', closeNav);
    });

    // 4. Listen for the 'Escape' key to close the menu for keyboard accessibility.
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && body.classList.contains('nav-is-open')) {
            closeNav();
        }
    });
}

/**
 * Initializes the interactive category filter for the Employment History list.
 * This script is only run on pages that need it (Résumé and Employment pages).
 */
function initEmploymentFilter() {
    // Get the container for the filter buttons and the list of items to filter.
    const filterContainer = document.querySelector('#employment-filter');
    const historyItems = document.querySelectorAll('#employment-list .history-item');

    // If either element is missing, stop the script.
    if (!filterContainer || historyItems.length === 0) return;

    // Listen for clicks anywhere inside the filter button container.
    filterContainer.addEventListener('click', (event) => {
        // Find the actual button that was clicked on.
        const clickedButton = event.target.closest('button');
        if (!clickedButton) return; // If the click wasn't on a button, do nothing.

        // Get the category to filter by from the button's 'data-filter' attribute.
        const filterCategory = clickedButton.dataset.filter;

        // Update the active state on the buttons.
        filterContainer.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
        clickedButton.classList.add('active');

        // Loop through each history item to show or hide it.
        historyItems.forEach(item => {
            const itemCategories = item.dataset.category;
            // Check if the item should be visible.
            if (filterCategory === 'all' || (itemCategories && itemCategories.includes(filterCategory))) {
                item.classList.remove('is-hidden'); // Show the item
            } else {
                item.classList.add('is-hidden'); // Hide the item
            }
        });
    });
}

/**
 * Initializes the interactive filter for the Projects list.
 * This script is very similar to the employment filter but targets the project cards.
 */
function initProjectFilter() {
    const filterContainer = document.querySelector('#project-filter');
    const projectItems = document.querySelectorAll('#project-list .card');

    if (!filterContainer || projectItems.length === 0) return;

    filterContainer.addEventListener('click', (event) => {
        const clickedButton = event.target.closest('button');
        if (!clickedButton) return;
        const filterCategory = clickedButton.dataset.filter;
        filterContainer.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
        clickedButton.classList.add('active');
        projectItems.forEach(item => {
            const itemCategories = item.dataset.category;
            if (filterCategory === 'all' || (itemCategories && itemCategories.includes(filterCategory))) {
                item.classList.remove('is-hidden');
            } else {
                item.classList.add('is-hidden');
            }
        });
    });
}

/**
 * Initializes the IT vs. Customer Service view toggler on the resume page.
 */
function initResumeToggler() {
    const viewToggler = document.querySelector('.view-toggle');
    if (!viewToggler) return;

    // Get all elements that are part of the "IT" view or "CS" view.
    const itViews = document.querySelectorAll('.resume-view-it');
    const csViews = document.querySelectorAll('.resume-view-cs');

    viewToggler.addEventListener('click', function(event) {
        const clickedButton = event.target.closest('button');
        if (!clickedButton) return;

        // Get the view to show from the button's 'data-view' attribute.
        const view = clickedButton.dataset.view;

        // Update active state on the buttons.
        viewToggler.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
        clickedButton.classList.add('active');

        // Show the elements for the selected view and hide the others.
        if (view === 'it') {
            itViews.forEach(el => el.classList.remove('is-hidden'));
            csViews.forEach(el => el.classList.add('is-hidden'));
        } else { // 'cs'
            itViews.forEach(el => el.classList.add('is-hidden'));
            csViews.forEach(el => el.classList.remove('is-hidden'));
        }
    });
}

/**
 * Fetches and displays a script from a raw GitHub URL in a preformatted block.
 * Uses the Prism.js library for syntax highlighting.
 */
function initLiveCodeEmbed() {
    const container = document.getElementById('script-container');
    if (!container) return;

    // The direct URL to the raw text file on GitHub.
    const rawUrl = 'https://raw.githubusercontent.com/raggiesoft/powershell-docx-converter/master/convert-and-split.ps1';

    // Use the Fetch API to get the content of the file.
    fetch(rawUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text(); // Get the response as plain text
        })
        .then(text => {
            // Place the fetched text into our code container.
            container.textContent = text;
            // If the Prism.js library is loaded, tell it to highlight our new content.
            if (window.Prism) {
                Prism.highlightElement(container);
            }
        })
        .catch(error => {
            // Handle errors (e.g., if GitHub is down or the file is moved).
            container.textContent = 'Error: Could not load script from GitHub.';
            console.error('Error fetching script:', error);
        });
}

/**
 * Makes any element with a `data-link` attribute clickable.
 * It also handles keyboard accessibility (Enter key) and
 * ignores clicks on any actual links or buttons inside the element.
 */
function initClickableCards() {
    const clickableItems = document.querySelectorAll('[data-link]');
    clickableItems.forEach(item => {
        // Handle mouse clicks
        item.addEventListener('click', function(event) {
            // If the user clicked on a link or button that's *inside* the card,
            // let that element handle the click and do nothing.
            if (event.target.closest('a, button')) {
                return;
            }

            // If the card has a valid link in its data attribute, navigate to it.
            if (this.dataset.link) {
                window.location.href = this.dataset.link;
            }
        });

        // Handle keyboard navigation for accessibility.
        item.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                // Simulate a click if the user presses the Enter key.
                this.click();
            }
        });
    });
}

/**
 * Initializes the accordion-based contact form flow.
 */
function initContactFlow() {
    const contactApp = document.getElementById('contact-flow-app');
    if (!contactApp) return;

    const salaryAccordion = document.getElementById('accordion-salary');
    const locationListDisplay = document.getElementById('location-list-display');

    const openAccordionFromHash = () => {
        if (!window.location.hash) return;
        const elementId = `accordion-${window.location.hash.substring(1)}`;
        const targetAccordion = document.getElementById(elementId);
        if (targetAccordion) {
            targetAccordion.open = true;
        }
    };

    const populateLocations = async () => {
        if (!locationListDisplay) return;
        try {
            const response = await fetch('/assets/json/locations.json');
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const locations = await response.json();

            locationListDisplay.innerHTML = '';
            locations.forEach(location => {
                const listItem = document.createElement('li');
                listItem.textContent = location.label;
                locationListDisplay.appendChild(listItem);
            });
        } catch (error) {
            console.error('Failed to load locations:', error);
        }
    };

    const handleSalaryCheck = async (event) => {
        event.preventDefault();
        const salaryForm = event.target;
        const resultContainer = document.getElementById('salary-result-container');
        const submitButton = salaryForm.querySelector('button[type="submit"]');
        const originalButtonHTML = submitButton.innerHTML;

        submitButton.innerHTML = 'Checking...';
        submitButton.disabled = true;

        try {
                const response = await fetch('/api/v1/salary-check', {
                method: 'POST',
                body: new FormData(salaryForm)
            });
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const result = await response.json();

            if (result.status === 'success') {
                if (salaryAccordion) salaryAccordion.open = false;
                const scheduleAccordion = document.getElementById('accordion-schedule');
                if(scheduleAccordion) scheduleAccordion.open = true;
            }
            displayMessage(result.status, result.title, result.message);

        } catch (error) {
            console.error('Salary checker API error:', error);
            displayMessage('danger', 'Error', 'Could not connect to the server.');
        } finally {
            submitButton.innerHTML = originalButtonHTML;
            submitButton.disabled = false;
        }
    };

    const injectSalaryChecker = () => {
        const container = document.getElementById('salary-checker-container');
        if (!container || container.querySelector('#contact-salary-form')) return;

        container.insertAdjacentHTML('afterbegin', `
            <form id="contact-salary-form" novalidate>
                <div class="form-row">
                    <div class="form-group"><label for="contact-salary-low">Salary Range (Low End)</label><input type="number" id="contact-salary-low" name="low" required></div>
                    <div class="form-group"><label for="contact-salary-high">Salary Range (High End)</label><input type="number" id="contact-salary-high" name="high"></div>
                    <div class="form-group"><label for="contact-salary-type">Rate</label><select id="contact-salary-type" name="type"><option value="yearly" selected>Per Year</option><option value="hourly">Per Hour</option></select></div>
                </div>
                <button type="submit" class="button button-primary">Check & Proceed</button>
            </form>
        `);

        document.getElementById('contact-salary-form').addEventListener('submit', handleSalaryCheck);
    };

    const displayMessage = (status, title, message) => {
        const resultContainer = document.getElementById('salary-result-container');
        if (resultContainer) {
            resultContainer.innerHTML = `<div class="alert alert-${status}" role="alert"><h4 class="alert-title">${title}</h4><p>${message}</p></div>`;
        }
    };

    populateLocations().then(() => {
        openAccordionFromHash();
    });

    if (salaryAccordion) {
        salaryAccordion.addEventListener('toggle', () => {
            if (salaryAccordion.open) {
                injectSalaryChecker();
            }
        });
    }
}

/**
 * Finds all external links on the page and adds target="_blank"
 * and rel="noopener noreferrer" for better UX and security.
 */
function initExternalLinks() {
    const allLinks = document.querySelectorAll('a[href]');
    const siteHost = window.location.hostname;

    allLinks.forEach(link => {
        // Check if the link's hostname is different from the site's own hostname
        if (link.hostname && link.hostname !== siteHost) {
            link.target = '_blank';
            link.rel = 'noopener noreferrer';
        }
    });
}

function initSalaryChecker() {
    const salaryForm = document.getElementById('salary-checker-form');
    if (!salaryForm) return;

    const resultContainer = document.getElementById('salary-result-container');

    salaryForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        const submitButton = salaryForm.querySelector('button[type="submit"]');
        const originalButtonHTML = submitButton.innerHTML;
        submitButton.innerHTML = 'Checking...';
        submitButton.disabled = true;

        const formData = new FormData(salaryForm);

        try {
            // Fetch from our new Laravel API route
            const response = await fetch('/api/v1/salary-check', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json', // Important for Laravel validation
                },
            });
            const result = await response.json();

            if (!response.ok) {
                // Handle Laravel's validation errors
                let errorMsg = result.message || 'Please check your input.';
                if (result.errors && result.errors.low) {
                    errorMsg = result.errors.low[0];
                }
                resultContainer.innerHTML = `<div class="alert alert-danger">${errorMsg}</div>`;
            } else {
                resultContainer.innerHTML = `<div class="alert alert-${result.status}"><h4 class="alert-title">${result.title}</h4><p>${result.message}</p></div>`;
            }
        } catch (error) {
            resultContainer.innerHTML = `<div class="alert alert-danger">An unexpected error occurred.</div>`;
        } finally {
            submitButton.innerHTML = originalButtonHTML;
            submitButton.disabled = false;
        }
    });
}

// --- Main Execution Block ---
// This is the "brain" of the script. It runs after the whole page has loaded.
document.addEventListener('DOMContentLoaded', function() {

    // --- Global Scripts ---
    // These functions run on every single page.
    initMobileNav();
    initExternalLinks();
    initClickableCards();

    // --- Page-Specific Scripts ---
    // This system checks the <body> tag for a 'data-page-script' attribute.
    // This is how we tell the JavaScript to only run the code needed for the current page.
    const pageScripts = document.body.dataset.pageScript;
    if (!pageScripts) return; // If the attribute doesn't exist, we're done.

    // The attribute can contain a space-separated list of scripts to run.
    const scriptsToRun = pageScripts.split(' ');

    // Check the list and run the corresponding initialization function.
    if (scriptsToRun.includes('employment-filter')) {
        initEmploymentFilter();
    }
    if (scriptsToRun.includes('resume-toggler')) {
        initResumeToggler();
    }
    if (scriptsToRun.includes('contact-flow')) {
        initContactFlow();
    }
    if (scriptsToRun.includes('project-filter')) {
        initProjectFilter();
    }
    if (scriptsToRun.includes('live-code-embed')) {
        initLiveCodeEmbed();
    }

    if (scriptsToRun.includes('salary-checker')) {
    initSalaryChecker();
}
});
