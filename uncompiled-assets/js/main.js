/**
 * My Portfolio Website
 * Copyright (c) 2025 Michael Ragsdale
 */

// ==========================================================================
// Function Declarations
// ==========================================================================

/**
 * Displays a message in the salary checker results container.
 * @param {string} message The HTML message to display.
 * @param {string} type The alert type (e.g., 'success', 'warning', 'danger').
 */
function displaySalaryMessage(message, type) {
    const resultContainer = document.getElementById('salary-result-container');
    if (resultContainer) {
        resultContainer.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
    }
}


// ==========================================================================
// Initialization and Event Listeners
// ==========================================================================

// --- Mobile Navigation Toggle ---
const mobileNavToggle = document.getElementById('mobile-nav-toggle');
const mainMenu = document.getElementById('main-menu');
if (mobileNavToggle && mainMenu) {
    mobileNavToggle.addEventListener('click', function() {
        mainMenu.classList.toggle('is-open');
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !isExpanded);
    });
}

// --- Email Obfuscation ---
const emailLinks = document.querySelectorAll('.email-obfuscate');
emailLinks.forEach(link => {
    const user = link.dataset.user;
    const domain = link.dataset.domain;
    if (user && domain) {
        link.href = 'mailto:' + user + '@' + domain;
    }
});

// --- Salary Checker ---
const salaryForm = document.getElementById('salary-checker-form');
if (salaryForm) {
    salaryForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const lowEndInput = document.getElementById('salary-low');
        const highEndInput = document.getElementById('salary-high');
        const typeSelect = document.getElementById('salary-type');

        const lowEnd = parseFloat(lowEndInput.value);
        const highEnd = parseFloat(highEndInput.value) || lowEnd;
        const type = typeSelect.value;

        if (isNaN(lowEnd) || lowEnd <= 0) {
            displaySalaryMessage('Please enter a valid starting salary.', 'danger');
            return;
        }

        const MY_MINIMUM_YEARLY = 75000;
        const MY_MINIMUM_HOURLY = 36.06;

        let meetsMinimum = false;
        if (type === 'yearly' && highEnd >= MY_MINIMUM_YEARLY) {
            meetsMinimum = true;
        } else if (type === 'hourly' && highEnd >= MY_MINIMUM_HOURLY) {
            meetsMinimum = true;
        }

        if (meetsMinimum) {
            const message = `<strong>Success!</strong> The provided salary range aligns with my expectations. I encourage you to schedule an interview.`;
            displaySalaryMessage(message, 'success');
        } else {
            const myMinimum = type === 'yearly' ? MY_MINIMUM_YEARLY.toLocaleString() : MY_MINIMUM_HOURLY.toFixed(2);
            const message = `<strong>Needs Discussion.</strong> The provided salary range is below my minimum requirement of \$${myMinimum}. While I am open to discussion, we may not be aligned on compensation.`;
            displaySalaryMessage(message, 'warning');
        }
    });
}

// --- Location List ---
const locationListContainer = document.getElementById('location-list-display');
if (locationListContainer) {
    fetch('/assets/json/locations.json')
        .then(response => response.json())
        .then(data => {
            if (data && data.locations) {
                data.locations.forEach(location => {
                    const li = document.createElement('li');
                    li.textContent = location;
                    locationListContainer.appendChild(li);
                });
            }
        })
        .catch(error => console.error('Error loading locations:', error));
}

// --- Project Filter ---
const projectFilter = document.getElementById('project-filter');
if (projectFilter) {
    const filterButtons = projectFilter.querySelectorAll('button');
    const projectList = document.getElementById('project-list');
    const projectItems = projectList ? projectList.querySelectorAll('.card') : [];

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            const filter = this.getAttribute('data-filter');

            projectItems.forEach(item => {
                const categories = item.getAttribute('data-category');
                if (filter === 'all' || (categories && categories.includes(filter))) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
}

// --- Clickable Cards ---
const clickableCards = document.querySelectorAll('.clickable-card');
clickableCards.forEach(card => {
    card.addEventListener('click', function() {
        const link = this.dataset.link;
        if (link) {
            window.location.href = link;
        }
    });
    card.addEventListener('keydown', function(event) {
        if (event.key === 'Enter' || event.key === ' ') {
            this.click();
        }
    });
});