/**
 * My Portfolio Website
 * Copyright (c) 2025 Michael Ragsdale
 *
 * This file contains the primary client-side JavaScript for the portfolio website.
 * It handles theme switching, mobile navigation, and interactive components like
 * the salary checker and project/employment filters.
 */

// ==========================================================================
//    #Event Listener for DOMContentLoaded
// ==========================================================================
// This is the main fix. By wrapping all the code in this event listener,
// we ensure that the JavaScript doesn't try to run until the entire HTML
// document has been loaded and is ready to be interacted with. This prevents
// "element not found" errors and ensures that all event listeners are
// attached correctly.
document.addEventListener('DOMContentLoaded', function() {

    // --- Theme Switcher ---
    const themeSwitcher = document.getElementById('theme-switcher');
    if (themeSwitcher) {
        themeSwitcher.addEventListener('change', function() {
            const selectedTheme = this.value;
            // Logic to apply the selected theme would go here.
            // For now, it might just log to the console or store in localStorage.
            console.log(`Theme changed to: ${selectedTheme}`);
        });
    }

    // --- Mobile Navigation ---
    const mobileNavToggle = document.getElementById('mobile-nav-toggle');
    const mainMenu = document.getElementById('main-menu');
    if (mobileNavToggle && mainMenu) {
        mobileNavToggle.addEventListener('click', function() {
            mainMenu.classList.toggle('is-open');
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
        });
    }

    // --- Salary Checker ---
    const salaryForm = document.getElementById('salary-checker-form');
    if (salaryForm) {
        salaryForm.addEventListener('submit', function(event) {
            event.preventDefault(); // This is the key line that was not being attached correctly.

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

    function displaySalaryMessage(message, type) {
        const resultContainer = document.getElementById('salary-result-container');
        if (resultContainer) {
            resultContainer.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
        }
    }

    // --- Location List ---
    // Dynamically loads and displays locations on pages that need it.
    const locationListContainer = document.getElementById('location-list-display');
    if (locationListContainer) {
        fetch('/assets/json/locations.json')
            .then(response => response.json())
            .then(data => {
                data.locations.forEach(location => {
                    const li = document.createElement('li');
                    li.textContent = location;
                    locationListContainer.appendChild(li);
                });
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
                    if (filter === 'all' || item.getAttribute('data-category').includes(filter)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    }
    
    // --- Clickable Cards ---
    // Makes cards with a data-link attribute behave like links.
    const clickableCards = document.querySelectorAll('.clickable-card');
    clickableCards.forEach(card => {
        card.addEventListener('click', function() {
            const link = this.dataset.link;
            if (link) {
                window.location.href = link;
            }
        });
        // Add keyboard accessibility
        card.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' || event.key === ' ') {
                this.click();
            }
        });
    });

}); // End of DOMContentLoaded listener
