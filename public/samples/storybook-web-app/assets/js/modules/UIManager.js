// assets/js/modules/UIManager.js

export class UIManager {
    constructor(domElements) {
        this.dom = domElements; 
        this.sidebarOpen = false; 
        // Ensure codexTabsContainer is explicitly referenced if passed in domElements
        // It's used to hide/show tabs independently of the main codex header on mobile.
        this.codexTabsContainer = this.dom.codexTabsContainer || (this.dom.codexModal ? this.dom.codexModal.querySelector('#codex-tabs-container') : null);
        
        // console.log("UIManager: Initialized.");
    }

    setMainAppTitle(title) {
        if (this.dom.mainAppTitle) {
            this.dom.mainAppTitle.textContent = title;
        }
        document.title = title;
    }

    showLibraryView() { 
        if (this.dom.libraryView) this.dom.libraryView.classList.remove('hidden');
        if (this.dom.storyView) this.dom.storyView.classList.add('hidden');
        if (this.dom.menuToggle) this.dom.menuToggle.classList.add('hidden'); 
        if (this.dom.codexToggle) this.dom.codexToggle.classList.add('hidden'); 
        if (this.dom.backToLibraryButton) this.dom.backToLibraryButton.classList.add('hidden');
        if (this.dom.hudStatusDisplay) this.dom.hudStatusDisplay.classList.add('hidden');
        // console.log("UIManager: Switched to library view.");
    }

    showStoryView() { 
        if (this.dom.libraryView) this.dom.libraryView.classList.add('hidden');
        if (this.dom.storyView) this.dom.storyView.classList.remove('hidden');
        if (this.dom.menuToggle) this.dom.menuToggle.classList.remove('hidden'); 
        if (this.dom.codexToggle) this.dom.codexToggle.classList.remove('hidden'); 
        if (this.dom.backToLibraryButton) this.dom.backToLibraryButton.classList.remove('hidden');
        // HUD visibility handled by HudManager based on chapter data
        // console.log("UIManager: Switched to story view.");
    }

    toggleSidebar(forceState = null) { 
        if (!this.dom.sidebar || !this.dom.overlay) {
            console.warn("UIManager.toggleSidebar: Sidebar or overlay element not found.");
            return;
        }
        const isLgScreen = window.matchMedia('(min-width: 1024px)').matches; 
        let show; 

        if (forceState !== null) { 
            show = forceState; 
        } else { 
            show = isLgScreen ? true : this.dom.sidebar.classList.contains('-translate-x-full');
        } 
        
        if (isLgScreen) { 
            this.dom.overlay.classList.add('hidden'); 
            this.dom.sidebar.classList.remove('-translate-x-full'); 
            this.dom.sidebar.classList.add('translate-x-0'); 
            this.sidebarOpen = true;
        } else { 
            if (show) { 
                this.dom.sidebar.classList.remove('-translate-x-full'); 
                this.dom.sidebar.classList.add('translate-x-0'); 
                this.dom.overlay.classList.remove('hidden'); 
                this.sidebarOpen = true;
            } else { 
                this.dom.sidebar.classList.add('-translate-x-full'); 
                this.dom.sidebar.classList.remove('translate-x-0'); 
                this.dom.overlay.classList.add('hidden');
                this.sidebarOpen = false;
            }
        }
    }

    updateActiveChapterInSidebar(flatChapterOrder, currentGlobalChapterIndex) {
        if (this.dom.tableOfContents && flatChapterOrder && flatChapterOrder.length > 0 && currentGlobalChapterIndex !== undefined) {
            this.dom.tableOfContents.querySelectorAll('a.chapter-link').forEach(link => {
                // Using href to match as dataset.globalIndex might not be on all <a> (e.g. summary links)
                const currentChapterDetailForLink = flatChapterOrder[currentGlobalChapterIndex];
                if (currentChapterDetailForLink && link.getAttribute('href') === `#chapter-${currentChapterDetailForLink.chapterKey}`) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });

            const currentChapterDetail = flatChapterOrder[currentGlobalChapterIndex];
            if(currentChapterDetail && currentChapterDetail.volumeKey){ // If part of a volume
                this.dom.tableOfContents.querySelectorAll('details.book-section').forEach(detailsEl => {
                    const summary = detailsEl.querySelector('.book-title-summary');
                    const icon = summary ? summary.querySelector('.book-arrow-icon') : null;
                    const ul = detailsEl.querySelector('.chapter-list-nested');
                    const shouldBeOpen = detailsEl.dataset.volumeKey === currentChapterDetail.volumeKey;
                    
                    if (detailsEl.open !== shouldBeOpen) {
                        if (shouldBeOpen) detailsEl.setAttribute('open', ''); 
                        else detailsEl.removeAttribute('open');
                    }
                    if(summary) summary.classList.toggle('open', shouldBeOpen);
                    if(ul) ul.classList.toggle('open', shouldBeOpen);
                    if(icon) { 
                        icon.classList.toggle('fa-chevron-right', !shouldBeOpen); 
                        icon.classList.toggle('fa-chevron-down', shouldBeOpen); 
                    }
                });
            }
        }
    }

    isCodexMobileView() {
        if (typeof window !== 'undefined' && window.matchMedia) {
            return window.matchMedia('(max-width: 767px)').matches; 
        }
        return false; 
    }

    showCodexListView() { // Primarily for mobile view management
        if (this.isCodexMobileView()) {
            if (this.dom.codexListWrapper) this.dom.codexListWrapper.classList.remove('hidden');
            if (this.dom.codexDetailPane) this.dom.codexDetailPane.classList.add('hidden');
            if (this.dom.codexBackToListButton) this.dom.codexBackToListButton.classList.add('hidden');
            if (this.codexTabsContainer) this.codexTabsContainer.classList.remove('hidden'); // Show tabs
        } else { // Desktop: ensure correct state
             if (this.dom.codexListWrapper) this.dom.codexListWrapper.classList.remove('hidden'); // Should be visible
             if (this.dom.codexDetailPane) this.dom.codexDetailPane.classList.remove('hidden'); // md:block takes care of this
             if (this.dom.codexBackToListButton) this.dom.codexBackToListButton.classList.add('hidden');
             if (this.codexTabsContainer) this.codexTabsContainer.classList.remove('hidden');
        }
    }

    showCodexDetailViewMobile(itemTitle = "Details") { // Renamed to be explicit for mobile
        if (this.isCodexMobileView()) {
            if (this.dom.codexListWrapper) this.dom.codexListWrapper.classList.add('hidden');
            if (this.dom.codexDetailPane) this.dom.codexDetailPane.classList.remove('hidden');
            if (this.dom.codexBackToListButton) this.dom.codexBackToListButton.classList.remove('hidden');
            if (this.codexTabsContainer) this.codexTabsContainer.classList.add('hidden'); // Hide tabs on mobile detail
            
            // Optionally update Codex title to item name on mobile for context
            // if (this.dom.mainAppTitle) this.dom.mainAppTitle.textContent = itemTitle; // This changes main header, might not be desired
            const codexTitleElement = document.getElementById('codex-title');
            if (codexTitleElement) codexTitleElement.textContent = itemTitle; // Change "Codex" to item name

        }
        // On desktop, detail pane is already visible via CSS (md:block)
        // Ensure back button remains hidden on desktop
        else if (this.dom.codexBackToListButton) {
             this.dom.codexBackToListButton.classList.add('hidden');
        }
    }

    toggleCodexModal(show, codexManagerInstance) { 
        if (!this.dom.codexModal) { return; }
        const isCurrentlyHidden = this.dom.codexModal.classList.contains('hidden');
        if (show) {
            if (isCurrentlyHidden) {
                this.dom.codexModal.classList.remove('hidden');
                const codexTitleElement = document.getElementById('codex-title');
                if (codexTitleElement) codexTitleElement.textContent = "Codex"; // Reset title on open

                if (codexManagerInstance) { 
                    codexManagerInstance.prepareAndShow();
                }
                this.showCodexListView(); // Default to list view when opening
            }
        } else { 
            if (!isCurrentlyHidden) this.dom.codexModal.classList.add('hidden'); 
        }
    }

    checkDarkMode() { 
        const isDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches; 
        document.documentElement.classList.toggle('dark', isDark); 
    }

    updateNextPrevButtons(flatChapterOrder, currentGlobalChapterIndex) {
        if (this.dom.prevButton) {
            this.dom.prevButton.disabled = (currentGlobalChapterIndex === 0);
        }
        if (this.dom.nextButton) {
            this.dom.nextButton.disabled = (!flatChapterOrder || currentGlobalChapterIndex >= flatChapterOrder.length - 1);
        }
    }

    updateSceneTitle(title) {
        if (this.dom.sceneTitle) this.dom.sceneTitle.textContent = title;
    }

    displayLoadingMessage(message = "Loading...", targetElement = this.dom.sceneText) {
        if (targetElement) {
            targetElement.innerHTML = `<p class="text-[var(--color-text-secondary)] p-4">${message}</p>`;
        }
    }

    displayErrorMessage(message, targetElement = this.dom.sceneText) {
        const errorHTML = `<p class="error-message p-4">${message}</p>`;
        if (targetElement) {
            targetElement.innerHTML = errorHTML;
        } else if (this.dom.libraryGrid) { 
            this.dom.libraryGrid.innerHTML = `<div class="col-span-full text-center">${errorHTML}</div>`;
        } else {
            console.error("No suitable element found to display error message:", message);
        }
    }
}