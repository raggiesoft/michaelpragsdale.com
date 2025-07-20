// assets/js/main.js

/**
 * My Portfolio Website
 * Copyright (c) 2025 Michael Ragsdale
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see <https://www.gnu.org/licenses/>.
 */

/**
 * Initializes the mobile navigation toggle and overlay.
 * This version includes "click outside to close" logic.
 */
function initMobileNav() {
    const body = document.body;
    const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
    const navIcon = document.querySelector('.mobile-nav-toggle .fa-duotone');
    const navPanel = document.querySelector('.site-navigation');

    // Exit if any essential elements are missing
    if (!mobileNavToggle || !navIcon || !navPanel) {
        console.warn('Mobile navigation elements not found. Nav will not be initialized.');
        return;
    }

    const closeNav = () => {
        body.classList.remove('nav-is-open');
        navIcon.classList.remove('fa-xmark');
        navIcon.classList.add('fa-bars');
        mobileNavToggle.setAttribute('aria-expanded', 'false');
    };

    const openNav = () => {
        body.classList.add('nav-is-open');
        navIcon.classList.remove('fa-bars');
        navIcon.classList.add('fa-xmark');
        mobileNavToggle.setAttribute('aria-expanded', 'true');
    };

    // --- Event Listeners ---

    // 1. Toggle button click
    mobileNavToggle.addEventListener('click', (event) => {
        event.stopPropagation(); // Prevent the click from bubbling up to the document
        body.classList.contains('nav-is-open') ? closeNav() : openNav();
    });

    // 2. Click anywhere on the document to close (click outside)
    document.addEventListener('click', (event) => {
        if (body.classList.contains('nav-is-open')) {
            // We check if the click was on the toggle button OR inside the nav panel.
            // If it was, we do nothing, letting other listeners handle it.
            // If it was anywhere else, we close the nav.
            const isClickInsideNav = navPanel.contains(event.target);
            const isClickOnToggle = mobileNavToggle.contains(event.target);

            if (!isClickInsideNav && !isClickOnToggle) {
                closeNav();
            }
        }
    });

    // 3. Close nav when pressing the Escape key
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && body.classList.contains('nav-is-open')) {
            closeNav();
        }
    });
}
/**
 * Initializes the interactive filter on the Employment and Résumé pages.
 */
function initEmploymentFilter() {
    const filterContainer = document.querySelector('#employment-filter');
    const historyItems = document.querySelectorAll('#employment-list .history-item');

    if (!filterContainer || historyItems.length === 0) return;

    filterContainer.addEventListener('click', (event) => {
        const clickedButton = event.target.closest('button');
        if (!clickedButton) return;

        const filterCategory = clickedButton.dataset.filter;

        filterContainer.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
        clickedButton.classList.add('active');

        historyItems.forEach(item => {
            const itemCategories = item.dataset.category;
            if (filterCategory === 'all' || itemCategories.includes(filterCategory)) {
                item.classList.remove('is-hidden');
            } else {
                item.classList.add('is-hidden');
            }
        });
    });
}

/**
 * Initializes the interactive filter on the Projects page.
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

    const itViews = document.querySelectorAll('.resume-view-it');
    const csViews = document.querySelectorAll('.resume-view-cs');

    viewToggler.addEventListener('click', function(event) {
        const clickedButton = event.target.closest('button');
        if (!clickedButton) return;

        const view = clickedButton.dataset.view;

        viewToggler.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
        clickedButton.classList.add('active');

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
 * Initializes the accordion-based contact flow.
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
            
            // Clear any old list items and build the new list
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
            const response = await fetch('/api/check-salary.php', { method: 'POST', body: new FormData(salaryForm) });
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const result = await response.json();
            
            if (result.status === 'success') {
                if (salaryAccordion) salaryAccordion.open = false;
                const scheduleAccordion = document.getElementById('accordion-schedule');
                if(scheduleAccordion) scheduleAccordion.open = true;
            }
            // Display message for both success and failure from the API now
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

    // --- Initial Setup & Event Listeners for Contact Flow ---
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

// --- Main Execution ---
document.addEventListener('DOMContentLoaded', function() {
    initMobileNav();
    initExternalLinks();

    const pageScripts = document.body.dataset.pageScript;
    if (!pageScripts) return;

    const scriptsToRun = pageScripts.split(' ');

    if (scriptsToRun.includes('employment-filter')) {
        initEmploymentFilter();
    }
    if (scriptsToRun.includes('resume-toggler')) {
        initResumeToggler();
    }
    if (scriptsToRun.includes('contact-flow')) {
        initContactFlow();
    }
    if (scriptsToRun.includes('project-filter')) { // <<< ADD THIS
        initProjectFilter();
    }
});