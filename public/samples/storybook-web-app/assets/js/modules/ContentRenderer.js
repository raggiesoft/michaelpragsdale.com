// assets/js/modules/ContentRenderer.js

export class ContentRenderer {
    constructor(sceneTextElement, tableOfContentsElement, hudManager) {
        this.sceneTextElement = sceneTextElement;
        this.tableOfContentsElement = tableOfContentsElement;
        this.hudManager = hudManager; // For preprocessing Markdown
        // console.log("ContentRenderer: Initialized.");
    }

    /**
     * Populates the library view with story series cards.
     * @param {Array} storySeriesArray - Array of series objects from library.json.
     * @param {HTMLElement} libraryGridElement - The DOM element to append cards to.
     * @param {Function} onSelectSeriesCallback - Callback function when a series is selected.
     */
    populateLibraryView(storySeriesArray, libraryGridElement, onSelectSeriesCallback) {
        if (!libraryGridElement) { 
            console.error("ContentRenderer.populateLibraryView: libraryGridElement not provided."); 
            return; 
        }
        libraryGridElement.innerHTML = ''; 
        if (!storySeriesArray || storySeriesArray.length === 0) {
            libraryGridElement.innerHTML = `<p class="text-[var(--color-text-secondary)] col-span-full text-center">No story series found in the library.</p>`;
            return;
        }

        storySeriesArray.forEach(series => {
            if (!series.id || !series.title) { 
                console.warn("ContentRenderer.populateLibraryView: Skipping series with missing id or title:", series); 
                return; 
            }
            const card = document.createElement('div');
            card.className = "p-4 rounded-lg shadow-lg cursor-pointer transition-all duration-300 ease-in-out hover:shadow-2xl hover:scale-105 border flex flex-col";
            card.style.backgroundColor = 'var(--color-bg-secondary)'; 
            card.style.borderColor = 'var(--color-border)';
            card.setAttribute('data-series-id', series.id); 

            const seriesId = series.id;
            const coverImageUrl = `books/${seriesId}/cover.png`; 
            
            const coverSection = document.createElement('div');
            coverSection.className = "w-full h-48 rounded-t-lg mb-4 relative bg-[var(--color-bg-button)] flex-shrink-0"; 
            const img = document.createElement('img'); 
            img.src = coverImageUrl; 
            img.alt = `${series.title} Cover`;
            img.className = "absolute inset-0 w-full h-full object-cover rounded-t-lg";
            const placeholder = document.createElement('div');
            placeholder.className = "no-cover-placeholder absolute inset-0 w-full h-full flex items-center justify-center text-[var(--color-text-secondary)] rounded-t-lg";
            placeholder.textContent = "Cover Art Missing"; 
            placeholder.style.display = 'none'; 
            img.onerror = () => { img.style.display = 'none'; placeholder.style.display = 'flex'; };
            img.onload = () => { placeholder.style.display = 'none'; img.style.display = 'block'; };
            coverSection.appendChild(img); 
            coverSection.appendChild(placeholder); 
            card.appendChild(coverSection);

            const textContentDiv = document.createElement('div'); 
            textContentDiv.className = "flex flex-col flex-grow";
            const titleEl = document.createElement('h3');
            titleEl.className = "text-xl font-bold mb-2 text-[var(--color-text-primary)]";
            titleEl.textContent = series.title; 
            textContentDiv.appendChild(titleEl);
            const descEl = document.createElement('p');
            descEl.className = "text-sm text-[var(--color-text-secondary)] mb-4 flex-grow";
            descEl.textContent = series.description || 'No description available.'; 
            textContentDiv.appendChild(descEl);
            
            const button = document.createElement('button');
            button.className = "read-series-button w-full font-bold py-2 px-4 rounded transition duration-200 mt-auto flex-shrink-0";
            button.textContent = "Read This Saga";
            button.style.backgroundColor = 'var(--color-accent)'; 
            button.style.color = 'var(--color-text-white)';
            button.onmouseover = () => { if(button) button.style.backgroundColor = 'var(--color-accent-hover)'; };
            button.onmouseout = () => { if(button) button.style.backgroundColor = 'var(--color-accent)'; };
            button.addEventListener('click', () => {
                if (typeof onSelectSeriesCallback === 'function') {
                    onSelectSeriesCallback(series);
                }
            });
            textContentDiv.appendChild(button); 
            card.appendChild(textContentDiv);
            libraryGridElement.appendChild(card);
        });
        // console.log("ContentRenderer.populateLibraryView: Library populated.");
    }

    /**
     * Populates the sidebar Table of Contents for the currently loaded series.
     * @param {Array} flatChapterOrder - The flat list of all chapters/intros for the series.
     * @param {string} currentSeriesId - The ID of the currently loaded series.
     * @param {object} masterBookData - The book.json data for the current series.
     */
    populateTableOfContentsForSeries(flatChapterOrder, currentSeriesId, masterBookData) {
        if (!this.tableOfContentsElement || !flatChapterOrder || flatChapterOrder.length === 0 ) {
             if(this.tableOfContentsElement) this.tableOfContentsElement.innerHTML = '<p class="p-4 text-sm text-[var(--color-text-secondary)]">No content structure found.</p>'; 
             console.warn("ContentRenderer.populateTableOfContentsForSeries: ToC element or chapter data not ready.");
             return;
        }
        this.tableOfContentsElement.innerHTML = '';
        
        const seriesIntroEntry = flatChapterOrder.find(ch => ch.isSeriesIntroduction && ch.seriesId === currentSeriesId);
        if (seriesIntroEntry) {
            const link = document.createElement('a');
            link.href = `#chapter-${seriesIntroEntry.chapterKey}`; 
            link.textContent = seriesIntroEntry.title; 
            link.classList.add('chapter-link', 'font-bold', 'text-lg', 'block', 'px-6', 'py-3'); 
            this.tableOfContentsElement.appendChild(link);
        }

        const volumesForToC = {};
        flatChapterOrder.forEach((chapterDetail) => {
            if (chapterDetail.volumeKey && chapterDetail.seriesId === currentSeriesId) { 
                if (!volumesForToC[chapterDetail.volumeKey]) {
                    const volIntroIndex = flatChapterOrder.findIndex(ch => ch.volumeKey === chapterDetail.volumeKey && ch.isVolumeIntroduction && ch.seriesId === currentSeriesId);
                    volumesForToC[chapterDetail.volumeKey] = { 
                        title: chapterDetail.volumeTitle, 
                        chapters: [],
                        volumeIntroChapterKey: volIntroIndex !== -1 ? flatChapterOrder[volIntroIndex].chapterKey : null
                    };
                }
                if (!chapterDetail.isVolumeIntroduction && !chapterDetail.isSeriesIntroduction) {
                    volumesForToC[chapterDetail.volumeKey].chapters.push(chapterDetail);
                }
            }
        });

        Object.keys(volumesForToC).sort().forEach(volumeKey => {
            const volume = volumesForToC[volumeKey];
            if (!volume.title) { return; }
            const bookDetails = document.createElement('details'); 
            bookDetails.className = 'book-section';
            bookDetails.dataset.volumeKey = volumeKey;
            // Active state and open state managed by UIManager.updateActiveChapterInSidebar

            const bookSummary = document.createElement('summary'); 
            bookSummary.className = 'book-title-summary';
            const summaryLink = document.createElement('a');
            summaryLink.style.cssText = 'display:flex; justify-content:space-between; width:100%; text-decoration:none; color:inherit;';
            summaryLink.innerHTML = `<span>${volume.title}</span><span class="arrow"><i class="fa-duotone fa-chevron-right fa-xs fa-fw book-arrow-icon" aria-hidden="true"></i></span>`;
            if (volume.volumeIntroChapterKey) { summaryLink.href = `#chapter-${volume.volumeIntroChapterKey}`; } 
            else { summaryLink.href = '#'; } 
            
            bookSummary.appendChild(summaryLink); 
            bookDetails.appendChild(bookSummary);
            
            const chapterListUl = document.createElement('ul'); 
            chapterListUl.className = 'chapter-list-nested';

            volume.chapters.sort((a,b) => a.title.localeCompare(b.title)).forEach(chapterInVolume => {
                const chapterLi = document.createElement('li'); 
                const link = document.createElement('a');
                link.href = `#chapter-${chapterInVolume.chapterKey}`; 
                link.textContent = chapterInVolume.title; 
                link.classList.add('chapter-link');
                // Store global index on the link for UIManager to manage active state
                const globalIdx = flatChapterOrder.indexOf(chapterInVolume);
                if (globalIdx !== -1) link.dataset.globalIndex = globalIdx;

                chapterLi.appendChild(link); 
                chapterListUl.appendChild(chapterLi);
            });
            bookDetails.appendChild(chapterListUl); 
            this.tableOfContentsElement.appendChild(bookDetails);
        });
        
        // Accordion toggle logic remains in UIManager or main.js (if it targets these specific elements)
        // For now, let's assume main.js will re-attach general summary click listeners if needed,
        // or this could be passed to UIManager to handle.
        // The primary role here is rendering the structure.
        // console.log("ContentRenderer.populateTableOfContentsForSeries (Sidebar): ToC populated.");
    }

    /**
     * Renders the fetched Markdown content into the scene text area.
     * @param {object} chapterDetail - The chapter object from flatChapterOrder.
     * @param {string} markdownContent - The raw Markdown string.
     */
    // assets/js/modules/ContentRenderer.js
    renderScene(chapterDetail, markdownContent) {
        if (!this.sceneTextElement) { /* ... */ return; }
        this.sceneTextElement.innerHTML = `<p class="text-center p-4 text-[var(--color-text-secondary)]"><i>Processing chapter content...</i></p>`; // Show processing message

        // Use a try...finally block to ensure processing message is cleared
        try {
            const { processedContent, initialStatusFromMarkdown } = this.hudManager.preprocessMarkdownForHudTriggers(markdownContent);
            this.hudManager.setChapterInitialHudStatus(initialStatusFromMarkdown);
            this.hudManager.updateHudDisplay(this.hudManager.getChapterInitialHudStatus());

            let htmlContent = "";
            if (typeof window.marked !== 'undefined' && typeof window.marked.parse === 'function') {
                htmlContent = window.marked.parse(processedContent);
            } else { /* ... fallback ... */ }

            this.sceneTextElement.innerHTML = htmlContent; 
            this.hudManager.setupHudIntersectionObserver(); 
        } catch (e) {
            console.error("Error during renderScene processing:", e);
            this.sceneTextElement.innerHTML = `<p class="error-message p-4">Error rendering chapter content.</p>`;
        }
    }
}