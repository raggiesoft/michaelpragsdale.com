/**
 * My Portfolio Website
 * Copyright (c) 2025 Michael Ragsdale
 */

console.log('[DEBUG] main.js script file has started executing.');

document.addEventListener('DOMContentLoaded', function() {
    console.log('[DEBUG] DOMContentLoaded event fired.');

    // --- Definitive Test for Element Availability ---
    // We will check for the button every 100ms for half a second.
    let attempts = 0;
    const interval = setInterval(function() {
        attempts++;
        const button = document.getElementById('mobile-nav-toggle');
        
        if (button) {
            // If we find the button, stop checking and initialize the site.
            console.log(`%c[SUCCESS] Found 'mobile-nav-toggle' on attempt ${attempts}.`, 'color: green; font-weight: bold;');
            clearInterval(interval);
            initializeApp(); 
        } else if (attempts >= 5) {
            // If we can't find it after 5 tries, stop and report failure.
            console.error(`%c[FAILURE] Could not find 'mobile-nav-toggle' after 5 attempts. The HTML element is missing or its ID is incorrect.`, 'color: red; font-weight: bold;');
            clearInterval(interval);
        } else {
             // Report that we are still looking.
             console.log(`[INFO] Attempt ${attempts}: 'mobile-nav-toggle' not found yet...`);
        }
    }, 100); // Check every 100 milliseconds

});

// --- Main application logic ---
// All your previous code is now moved into this function.
function initializeApp() {
    console.log('[DEBUG] Initializing all application functionality.');

    const mobileNavToggle = document.getElementById('mobile-nav-toggle');
    const mainMenu = document.getElementById('main-menu');
    if (mobileNavToggle && mainMenu) {
        mobileNavToggle.addEventListener('click', function() {
            mainMenu.classList.toggle('is-open');
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
        });
    }

    const emailLinks = document.querySelectorAll('.email-obfuscate');
    emailLinks.forEach(link => {
        const user = link.dataset.user;
        const domain = link.dataset.domain;
        if (user && domain) {
            link.href = 'mailto:' + user + '@' + domain;
        }
    });

    const salaryForm = document.getElementById('salary-checker-form');
    if (salaryForm) {
        salaryForm.addEventListener('submit', function(event) {
            event.preventDefault();
            // ... (rest of salary checker code)
        });
    }
    
    // ... (include the rest of your functions: displaySalaryMessage, location list, project filter, etc.)
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

    console.log('[DEBUG] Application initialization complete.');
}