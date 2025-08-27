/**
 * My Portfolio Website
 * Copyright (c) 2025 Michael Ragsdale
 */

console.log('--- SCRIPT START ---');

// ==========================================================================
// Function Declarations
// ==========================================================================
console.log('1. Defining displaySalaryMessage function...');
function displaySalaryMessage(message, type) {
    console.log('Function displaySalaryMessage CALLED.');
    const resultContainer = document.getElementById('salary-result-container');
    if (resultContainer) {
        console.log('...found salary-result-container, updating innerHTML.');
        resultContainer.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
    } else {
        console.error('...salary-result-container NOT FOUND.');
    }
}
console.log('...function defined.');

// ==========================================================================
// Initialization and Event Listeners
// ==========================================================================
console.log('2. Starting initializations...');

// --- Mobile Navigation Toggle ---
console.log('3. Setting up Mobile Navigation Toggle...');
console.log('...getting #mobile-nav-toggle');
const mobileNavToggle = document.getElementById('mobile-nav-toggle');
console.log('...getting #main-menu');
const mainMenu = document.getElementById('main-menu');

if (mobileNavToggle && mainMenu) {
    console.log('...SUCCESS: Found both nav toggle and main menu elements.');
    console.log('...attaching click listener to nav toggle.');
    mobileNavToggle.addEventListener('click', function() {
        console.log('--- CLICK EVENT: Mobile Nav Toggle Fired! ---');
        mainMenu.classList.toggle('is-open');
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !isExpanded);
        console.log('...menu class toggled.');
    });
} else {
    console.error('...FAILURE: Could not find nav toggle or main menu. mobileNavToggle:', mobileNavToggle, 'mainMenu:', mainMenu);
}

// --- Email Obfuscation ---
console.log('4. Setting up Email Obfuscation...');
console.log('...getting .email-obfuscate elements');
const emailLinks = document.querySelectorAll('.email-obfuscate');
console.log(`...found ${emailLinks.length} elements.`);
emailLinks.forEach((link, index) => {
    console.log(`...processing email link #${index + 1}`);
    const user = link.dataset.user;
    const domain = link.dataset.domain;
    if (user && domain) {
        link.href = 'mailto:' + user + '@' + domain;
        console.log('...href updated.');
    } else {
        console.warn('...user or domain data attributes missing.');
    }
});

// --- Salary Checker ---
console.log('5. Setting up Salary Checker...');
console.log('...getting #salary-checker-form');
const salaryForm = document.getElementById('salary-checker-form');
if (salaryForm) {
    console.log('...SUCCESS: Found salary form.');
    console.log('...attaching submit listener.');
    salaryForm.addEventListener('submit', function(event) {
        console.log('--- SUBMIT EVENT: Salary Form Fired! ---');
        event.preventDefault();
        // ... rest of salary checker logic ...
    });
} else {
    console.log('...INFO: Salary form not found on this page.');
}


// --- Location List ---
console.log('6. Setting up Location List...');
console.log('...getting #location-list-display');
const locationListContainer = document.getElementById('location-list-display');
if (locationListContainer) {
    console.log('...SUCCESS: Found location list container.');
    console.log('...fetching locations.json');
    fetch('/assets/json/locations.json')
        .then(response => {
            console.log('...fetch response received.');
            return response.json();
        })
        .then(data => {
            console.log('...JSON data parsed.');
            if (data && data.locations) {
                data.locations.forEach(location => {
                    const li = document.createElement('li');
                    li.textContent = location;
                    locationListContainer.appendChild(li);
                });
                console.log('...location list populated.');
            }
        })
        .catch(error => console.error('--- FETCH ERROR: Error loading locations.json:', error));
} else {
    console.log('...INFO: Location list container not found on this page.');
}

// --- Project Filter ---
console.log('7. Setting up Project Filter...');
console.log('...getting #project-filter');
const projectFilter = document.getElementById('project-filter');
if (projectFilter) {
    console.log('...SUCCESS: Found project filter container.');
    const filterButtons = projectFilter.querySelectorAll('button');
    console.log(`...found ${filterButtons.length} filter buttons.`);
    // ... rest of project filter logic ...
} else {
    console.log('...INFO: Project filter not found on this page.');
}

// --- Clickable Cards ---
console.log('8. Setting up Clickable Cards...');
console.log('...getting .clickable-card elements');
const clickableCards = document.querySelectorAll('.clickable-card');
console.log(`...found ${clickableCards.length} clickable cards.`);
clickableCards.forEach((card, index) => {
    console.log(`...attaching listeners to card #${index + 1}`);
    card.addEventListener('click', function() {
        console.log(`--- CLICK EVENT: Card #${index + 1} Fired! ---`);
        const link = this.dataset.link;
        if (link) {
            window.location.href = link;
        }
    });
    card.addEventListener('keydown', function(event) {
        if (event.key === 'Enter' || event.key === ' ') {
            console.log(`--- KEYDOWN EVENT: Card #${index + 1} Fired! ---`);
            this.click();
        }
    });
});

console.log('--- SCRIPT END --- All initializations complete.');