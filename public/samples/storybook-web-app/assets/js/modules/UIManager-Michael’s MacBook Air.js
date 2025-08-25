// assets/js/modules/UIManager.js

export class UIManager {
    constructor(domElements) {
        this.dom = domElements; // Store all passed DOM elements
        this.sidebarOpen = false; // Internal state for sidebar
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
        console.log("UIManager: Switched to library view.");
    }

    showStoryView() { 
        if (this.dom.libraryView) this.dom.libraryView.classList.add('hidden');
        if (this.dom.storyView) this.dom.storyView.classList.remove('hidden');
        if (this.dom.menuToggle) this.dom.menuToggle.classList.remove('hidden'); 
        if (this.dom.codexToggle) this.dom.codexToggle.classList.remove('hidden'); 
        if (this.dom.backToLibraryButton) this.dom.backToLibraryButton.classList.remove('hidden');
        // HUD visibility will be managed by HudManager based on chapter data
        console.log("UIManager: Switched to story view.");
    }

    toggleSidebar(forceState = null) { 
        if (!this.dom.sidebar || !this.dom.overlay) {
            console.warn("UIManager.toggleSidebar: Sidebar or overlay element not found.");
            return;
        }
        const isLg = window.matchMedia('(min-width: 1024px)').matches; 
        let show; 

        if (forceState !== null) { 
            show = forceState; 
        } else { 
            show = isLg ? true : this.dom.sidebar.classList.contains('-translate-x-full');
        } 
        
        if (isLg) { 
            this.dom.overlay.classList.add('hidden'); 
            this.dom.sidebar.classList.remove('-translate-x-full'); 
            this.dom.sidebar.classList.add('translate-x-0'); 
            this.sidebarOpen = true; // On large screens, it's conceptually "open"
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
        // console.log("UIManager.toggleSidebar: Sidebar state - open:", this.sidebarOpen);
    }

    checkDarkMode() { 
        const isDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches; 
        document.documentElement.classList.toggle('dark', isDark); 
        // console.log("UIManager.checkDarkMode: Dark mode set to", isDark);
    }

    toggleCodexModal(show, codexManagerInstance) { 
        if (!this.dom.codexModal) { 
            console.error("UIManager.toggleCodexModal: Codex modal element not found!"); 
            return; 
        }
        const isCurrentlyHidden = this.dom.codexModal.classList.contains('hidden');
        if (show) {
            if (isCurrentlyHidden) {
                this.dom.codexModal.classList.remove('hidden');
                if (codexManagerInstance) { 
                    codexManagerInstance.prepareAndShow(); // Tell CodexManager to populate itself
                }
            }
        } else { 
            if (!isCurrentlyHidden) this.dom.codexModal.classList.add('hidden'); 
        }
    }

    updateActiveChapterInSidebar(flatChapterOrder, currentGlobalChapterIndex) {
        if (this.dom.tableOfContents && flatChapterOrder && flatChapterOrder.length > 0) {
            this.dom.tableOfContents.querySelectorAll('.chapter-link').forEach(link => {
                // Assuming chapter links in sidebar now have their href set to the hash
                // e.g. href="#chapter-b1_ch1"
                const linkHash = link.getAttribute('href');
                const currentChapterHash = (flatChapterOrder[currentGlobalChapterIndex]) 
                                           ? `#chapter-${flatChapterOrder[currentGlobalChapterIndex].chapterKey}` 
                                           : null;
                link.classList.toggle('active', linkHash === currentChapterHash);
            });

            const currentChapterDetail = flatChapterOrder[currentGlobalChapterIndex];
            if(currentChapterDetail && currentChapterDetail.volumeKey){
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

    updateNextPrevButtons(flatChapterOrder, currentGlobalChapterIndex) {
        if (this.dom.prevButton) {
            this.dom.prevButton.disabled = (currentGlobalChapterIndex === 0);
        }
        if (this.dom.nextButton) {
            this.dom.nextButton.disabled = (currentGlobalChapterIndex >= flatChapterOrder.length - 1);
        }
    }

    updateSceneContent(title, htmlContent) {
        if (this.dom.sceneTitle) this.dom.sceneTitle.textContent = title;
        if (this.dom.sceneText) {
            this.dom.sceneText.innerHTML = htmlContent;
            this.dom.sceneText.scrollTop = 0;
        }
    }

    displayLoadingMessage(message = "Loading...") {
        if (this.dom.sceneText) {
            this.dom.sceneText.innerHTML = `<p class="text-[var(--color-text-secondary)] p-4">${message}</p>`;
        }
    }

    displayErrorMessage(message, inSceneText = true) {
        const errorHTML = `<p class="error-message p-4">${message}</p>`;
        if (inSceneText && this.dom.sceneText) {
            this.dom.sceneText.innerHTML = errorHTML;
        } else if (this.dom.libraryGrid) { // Fallback for library errors
            this.dom.libraryGrid.innerHTML = `<div class="col-span-full text-center">${errorHTML}</div>`;
        } else {
            console.error("No suitable element found to display error message:", message);
        }
    }
}