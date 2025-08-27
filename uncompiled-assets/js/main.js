/**
 * My Portfolio Website
 * Copyright (c) 2025 Michael Ragsdale
 *
 * This file contains the primary client-side JavaScript for the portfolio website.
 */

console.log('[DEBUG] main.js script file has started executing.');

document.addEventListener('DOMContentLoaded', function() {

    console.log('[DEBUG] DOMContentLoaded event has fired. Initializing script sections.');

    // --- Mobile Navigation Toggle (FIX) ---
    const mobileNavToggle = document.getElementById('mobile-nav-toggle');
    const mainMenu = document.getElementById('main-menu');
    console.log('[DEBUG] mobileNavToggle found:', mobileNavToggle ? 'Yes' : 'No');
    console.log('[DEBUG] mainMenu found:', mainMenu ? 'Yes' : 'No');
    if (mobileNavToggle && mainMenu) {
        console.log('[DEBUG] Initializing Mobile Navigation Toggle.');
        mobileNavToggle.addEventListener('click', function() {
            mainMenu.classList.toggle('is-open');
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            console.log('Mobile menu toggled. Now expanded:', !isExpanded);
        });
    }

    // --- Email Obfuscation (NEW) ---
    console.log('[DEBUG] Initializing Email Obfuscation.');
    const emailLinks = document.querySelectorAll('.email-obfuscate');
    console.log(`[DEBUG] Found ${emailLinks.length} email links to obfuscate.`);
    emailLinks.forEach(link => {
        const user = link.dataset.user;
        const domain = link.dataset.domain;
        if (user && domain) {
            link.href = 'mailto:' + user + '@' + domain;
        }
    });

    // --- Salary Checker ---
    const salaryForm = document.getElementById('salary-checker-form');
    console.log('[DEBUG] salaryForm found:', salaryForm ? 'Yes' : 'No');
    if (salaryForm) {
        console.log('[DEBUG] Initializing Salary Checker.');
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

    function displaySalaryMessage(message, type) {
        const resultContainer = document.getElementById('salary-result-container');
        if (resultContainer) {
            resultContainer.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
        }
    }

    // --- Location List ---
    const locationListContainer = document.getElementById('location-list-display');
    console.log('[DEBUG] locationListContainer found:', locationListContainer ? 'Yes' : 'No');
    if (locationListContainer) {
        console.log('[DEBUG] Initializing Location List.');
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
    console.log('[DEBUG] projectFilter found:', projectFilter ? 'Yes' : 'No');
    if (projectFilter) {
        console.log('[DEBUG] Initializing Project Filter.');
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
    console.log('[DEBUG] Initializing Clickable Cards.');
    const clickableCards = document.querySelectorAll('.clickable-card');
    console.log(`[DEBUG] Found ${clickableCards.length} clickable cards.`);
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
    
    console.log('[DEBUG] main.js script has finished executing.');
});